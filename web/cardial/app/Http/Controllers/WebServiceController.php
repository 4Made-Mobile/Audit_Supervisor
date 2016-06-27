<?php

namespace cardial\Http\Controllers;

use cardial\Http\Requests;
use cardial\Usuario;
use Request;
use cardial\Supervisor;
use cardial\VisitaBase;
use cardial\Pergunta;

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
                        select('cliente.cidade', 'visita.id', 'visita.data_inicial', 'cliente.razao_social', 'vendedor.id', 'vendedor.nome', 'formulario.id')
                        ->where('visita_base.supervisor_id', $supervisor_id)
                        ->where('visita.data_inicial', '>', date('Y-m-d', strtotime("-1 days")))
                        ->where('visita.data_inicial', '<=', date('Y-m-d', strtotime("+29 days")))
                        ->get();

                return $visitas;
                // monta as visitas
//                foreach ($visitas as $key => $item) {
//                    $dados[1][$item["data_inicial"] = array(
//                    $item["cidade"],
//                    $item["id"],
//                    $item["razao_social"],
//                    $item["vendedor_id"],
//                    $item["vendedor_nome"],
//                    $item["formulario_id"],
//                    );
                }

                // monta as perguntas
                $dados[2][$formulario_id] = array(
                    $item->id,
                    $item->descricao,
                    $item->obrigatorio,
                    $item->ordem,
                    $item->visita_id
                );

                return json_encode($dados);
            }
        }

        return json_encode(array("false"));
    }

    public function recebeRespostas() {
        // dados que sairam de arthur: respostas, supervisor_id, visita, chave_acesso
        // adiciono tudo no banco de dados
        // retorno se deu certo ou não
    }

}
