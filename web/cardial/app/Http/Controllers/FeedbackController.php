<?php

namespace cardial\Http\Controllers;

use Illuminate\Http\Request;

use cardial\Http\Requests;

class FeedbackController extends Controller
{
    
	public function listaGeral(){
		$feedback = new Feedback::all()->orderBy('supervisor_id');
		return view('feedback.lista-geral')->with('feedback',$feedback);
	}

}