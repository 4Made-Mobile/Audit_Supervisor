<?php

namespace cardial\Http\Controllers;

use Illuminate\Http\Request;

use cardial\Http\Requests;
use cardial\Usuario;
use cardial\Supervisor;

class UsuarioController extends Controller
{
   	
   	// lista-geral das funções
	public function listaGeral(){		
		$usuarios = Usuario::all();
		return view('usuario.lista-geral')->with('usuarios', $usuarios);
	}

		// lista-geral das funções
	public function imei($id){		
		
		// verifica se o id não está nulo
		if($id != null && !empty($id)){
			$usuario = Usuario::find($id);
			$usuario->imei = "";
			$usuario->chave = "";
			$usuario->save();
		}

		return redirect()->action('UsuarioController@listaGeral');
	}

		// lista-geral das funções
	public function edita($id){		
		$usuarios = Usuario::all();
		return view('usuario.lista-geral')->with('usuarios', $usuarios);
	}

		// lista-geral das funções
	public function altera(){		
		$usuarios = Usuario::all();
		return view('usuario.lista-geral')->with('usuarios', $usuarios);
	}


}
