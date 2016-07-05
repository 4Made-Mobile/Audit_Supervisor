<?php

namespace cardial\Http\Controllers;

use cardial\Http\Requests\PerguntaRequest;
use cardial\Pergunta;
use cardial\Formulario;
use Requests;

class FormularioController extends Controller {

        public function novo()
        {
            return view('formulario.form-novo');
        }

        public function finalizar()
        {
        	if(empty($_GET['id_formulario']) && $_GET['id_formulario'] != '0')
        		return json_encode("erooou!");

        	return json_encode("acertou");
        }

        public function listaPergunta(){
            $id_formulario = Requests::input('id_formulario');
            $perguntas = Pergunta
        }
    
}