<?php

namespace cardial\Http\Controllers;

use Request;

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
		$usuario = Usuario::find($id);
		return view('usuario.edit-usuario')->with('usuario', $usuario);
	}

	// lista-geral das funções
	public function altera(){	
		
		$id = Request::input('id');	
		$senha = Request::input('senha');

		$usuario = Usuario::find($id);

		if(!empty($senha)){
			$usuario->senha = md5($senha);
		}

		$usuario->login = Request::input('login');
		$usuario->save();

		return redirect()->action('UsuarioController@listaGeral');
	}


}
