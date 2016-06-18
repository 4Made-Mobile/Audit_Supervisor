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
            return json_encode(array('login' => false));

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
                return json_encode(array('login' => true, 'chave' => $usuario->chave, 'id' => $usuario->id));
            }
        }
        return json_encode(array('login' => false));
    }

    public function listaVisita() {
        if (!empty($_GET['supervisor_id']) && !empty($_GET['chave'])) {
            $supervisor_id = $_GET['supervisor_id'];
            $chave = $_GET['chave'];
            $usuario = Usuario::find($supervisor_id);
            if ($usuario->chave == $chave) {
                $visita_base = $this->visitasBases($supervisor_id);

                foreach ($visita_base as $key => $item) {
                    $ultima_visita = VisitaBase::join('visita', 'visita_base.id', '=', 'visita.visita_id')
                            ->select('visita.data_inicial')
                            ->where('visita_base.cliente_id', $item->cliente_id)
                            ->where('visita.situacao', 'CONCLUIDO')
                            ->get()
                            ->last();
                    $visita_base[$key]->ultima_visita = $ultima_visita->data_inicial;
                }


                $formulario = Pergunta::all()->where('visivel', 'S');
                $dados = array(
                    $visita_base,
                    $formulario
                );
                return json_encode($dados);
            }
        }
        return json_encode(false);
    }

    private function visitasBases($supervisor_id) {
        return VisitaBase::
                        join('visita', 'visita_base.id', '=', 'visita.visita_id')->
                        join('cliente', 'visita_base.cliente_id', '=', 'cliente.id')->
                        join('vendedor', 'visita_base.vendedor_id', '=', 'vendedor.id')->
                        select('cliente.cidade', 'visita.id', 'visita.data_inicial', 'visita_base.cliente_id', 'cliente.razao_social', 'visita_base.vendedor_id', 'vendedor.nome')
                        ->where('visita_base.supervisor_id', $supervisor_id)
                        ->where('visita.data_inicial', '>', date('Y-m-d', strtotime("-1 days")))
                        ->where('visita.data_inicial', '<=', date('Y-m-d', strtotime("+29 days")))
                        ->get();
    }

    public function recebeRespostas() {
        // dados que sairam de arthur: respostas, supervisor_id, visita, chave_acesso
        // adiciono tudo no banco de dados
        // retorno se deu certo ou não
    }

}
