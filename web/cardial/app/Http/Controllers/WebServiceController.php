<?php

namespace cardial\Http\Controllers;

use cardial\Http\Requests;
use cardial\Usuario;
use Request;
use cardial\Resposta;
use cardial\Supervisor;
use cardial\VisitaBase;
use cardial\Visita;
use cardial\Pergunta;
use DB;

class WebServiceController extends Controller {

    public function verificaLogin() {
        if (empty($_GET['login']) && empty($_GET['senha']))
            return json_encode(array('login' => "false"));

        $login = $_GET['login'];
        $senha = $_GET['senha'];

        $usuario = Usuario::all()->where('login', $login)->first();
        $chave_vazia = $usuario->chave == null || $usuario->imei == null;
        if ($chave_vazia && !empty($_GET['imei'])) {
            $imei = $_GET['imei'];
            $usuario->chave = md5($login + date("d-m-Y") + rand(0, 1));
            $usuario->imei = $imei;
        }

        if (!empty($usuario)) {
            $autenticao = $usuario->login == $login && $usuario->senha == $senha;
            if ($autenticao) {
                $usuario->save();
                return json_encode(array('login' => "true", 'chave' => $usuario->chave, 'id' => $usuario->id));
            }
        }
        return json_encode(array('login' => "false"));
    }

    public function listaVisita() {

        if (!empty($_GET['supervisor_id']) && !empty($_GET['chave'])) {
            $supervisor_id = $_GET['supervisor_id'];
            $chave = $_GET['chave'];

            $usuario = Usuario::find($supervisor_id);

            // se não encontrar o ID retorna falso
            if (empty($usuario))
                return json_encode(array("false"));

            if ($usuario->chave == $_GET['chave']) {
                $dados = array("true", array(), array());

                // estrutura dos dados
                // busca as visitas de hoje até 29 dias desse supervisor
                $visitas = VisitaBase::
                        join('visita', 'visita_base.id', '=', 'visita.visita_id')->
                        join('cliente', 'visita_base.cliente_id', '=', 'cliente.id')->
                        join('vendedor', 'visita_base.vendedor_id', '=', 'vendedor.id')->
                        join('formulario', 'visita_base.formulario_id', '=', 'formulario.id')->
                        select('cliente.cidade AS cidade',
                                'visita_base.id AS visita_base_id',
                                'visita.id AS visita_id',
                                'visita.data_inicial',
                                'cliente.razao_social',
                                'vendedor.id AS vendedor_id',
                                'vendedor.nome AS vendedor_nome',
                                'formulario.id AS formulario_id')->
                        where('visita_base.supervisor_id', $supervisor_id)->
                        where('visita.situacao', 'ABERTO')->
                        where('visita.data_inicial', '>', date('Y-m-d', strtotime("-1 days")))->
                        where('visita.data_inicial', '<=', date('Y-m-d', strtotime("+29 days")))->
                        get();

                // Perguntas
                $perguntas = Pergunta::
                        join('pergunta_formulario', 'pergunta.id', '=', 'pergunta_formulario.pergunta_id')->
                        join('formulario', 'pergunta_formulario.formulario_id', '=', 'formulario.id')->
                        select('formulario.id AS formulario_id',
                               'pergunta.id AS pergunta_id',
                               'pergunta.descricao',
                               'pergunta.obrigatoria',
                               'pergunta.ordem',
                               'pergunta.tipo')->
                        where('pergunta.visivel', 'S')->
                        get();
                

                // data das últimas visitas
                $ultima_visita = Visita::
                        select('visita.visita_id', DB::raw('MAX(visita.data_final) AS data_final'))->
                        groupBy('visita.visita_id')->
                        where('visita.situacao', 'CONCLUIDO')->
                        get();

                // monta as visitas
                foreach ($visitas as $key => $item) {

                    foreach ($ultima_visita as $var) {
                        if($item["visita_base_id"] == $var["visita_id"])
                            $data_final = $var["data_final"];
                    }

                    $dados[1][$item["data_inicial"]][] = array(
                        $item["cidade"],
                        $item["visita_id"],
                        $item["razao_social"],
                        $item["vendedor_id"],
                        $item["vendedor_nome"],
                        $item["formulario_id"],
                        $data_final,
                    );
                }

                foreach($perguntas as $item){
                    $dados[2][$item["formulario_id"]][] = array(
                            $item['pergunta_id'],
                            $item['descricao'],
                            $item['obrigatoria'],
                            $item['ordem'],
                            $item['tipo'],
                        );
                }

                return json_encode($dados);
            }
        }

        return json_encode(array("false"));
    }

    public function resposta() {

        // forma que os dados chegam
        /*array_requisicao = {
                            "supervisor_id": id, 
                            "chave": key,
                            "formulario": array_formulario
                            };

        array_formulario = {"visita_id": id,
                            "formulario_id": id,
                            "gps_inicial": gps_inicial,
                            "gps_final": gps_final,
                            "data_inicio": data_inicial,
                            "data_fim": data_final,
                            "respostas": array_resposta
                            };

        array_resposta = {"descricao": resposta, "pergunta_id": pergunta_id}; */

        // verifica se todos os valores estão preenchidos
        $dados_recebido = json_decode(Request::input('array_requisicao'));

        if(empty($dados_recebido) || empty($dados_recebido->supervisor_id) || empty($dados_recebido->chave) || empty($dados_recebido->formulario))
            return json_encode(array("false"));

        // verifica se o formulário está okay
        $formulario = $dados_recebido->formulario;
        if(empty($formulario->respostas))
            return json_encode(array("false"));

        // verifica se a chave dos dados está correta
        $supervisor_id = $dados_recebido->supervisor_id;
        $chave = $dados_recebido->chave;

        $usuario = Usuario::find($supervisor_id);
        // se não encontrar o ID retorna falso
        if (empty($usuario))
            return json_encode(array("false"));

        $requisicao_valida = $usuario->chave == $dados_recebido->chave;
        if ($requisicao_valida) {
            // percorreu todos os formulários
            // adiciona o gps inicial e final. // adiciona hora inicial e final
            $visita = Visita::find($formulario->visita_id);
            $visita->pesquisa_inicio = $formulario->data_inicio;
            $visita->pesquisa_fim = $formulario->data_fim;
            $visita->gps_inicio = $formulario->gps_inicial;
            $visita->gps_fim = $formulario->gps_final;
            $visita->data_final = date('Y-m-d');
            $visita->situacao = 'CONCLUIDO';

            $visita->save();

            $respostas = $formulario->respostas;
            foreach($respostas AS $res){
                Resposta::create(array(
                        'descricao' => $res->descricao,
                        'pergunta_id' => $res->pergunta_id,
                    ));
            }

            return json_encode("true");
        }

        return json_encode("false");
    }

}
