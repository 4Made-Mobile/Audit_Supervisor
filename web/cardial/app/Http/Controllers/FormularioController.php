<?php

namespace cardial\Http\Controllers;

use cardial\Http\Requests\PerguntaRequest;
use cardial\Pergunta;
use cardial\Formulario;
use Request;

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

        public function removePergunta(){

            $id_formulario = Request::input('id');
            $pergunta = Pergunta::find(intval($id_formulario));
            return json_encode($pergunta);

        }

        public function listaPergunta(){
            $id_formulario = Request::input('id');
            
            $perguntas = Pergunta::
                        join('pergunta_formulario', 'pergunta.id', '=', 'pergunta_formulario.pergunta_id')->
                        join('formulario', 'pergunta_formulario.formulario_id', '=', 'formulario.id')->
                        select('pergunta.id AS pergunta_id',
                               'pergunta.descricao',
                               'pergunta.obrigatoria',
                               'pergunta.ordem',
                               'pergunta.visivel',
                               'pergunta.tipo')->
                        where('pergunta.visivel', 'S')->
                        where('formulario.id', $id_formulario)->
                        orderBy('pergunta.ordem')->
                        get();

            return json_encode($perguntas);
        }
    
}