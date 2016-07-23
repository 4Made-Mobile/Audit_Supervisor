<?php

namespace cardial\Http\Controllers;

use Illuminate\Http\Request;

use cardial\Http\Requests;

class FeedbackController extends Controller
{
    
	public function edita(){
		return view('feedback.edita-feedback');
	}

	public function adicionaPergunta(){

		// adiciona perguntas

		return redirect()
					->action('FeedbackController@listaGeral');
	}

	public function Removepergunta(){

		// verifica se o ID é null
		if($_GET['id'] != null){

		}

		return redirect()
					->action('FeedbackController@listaGeral');	
	}

	public function listaGeral(){
		return view('feedback.lista-geral');
	}

	public function relatorio(){
		return view('feedback.relatorio');
	}

}