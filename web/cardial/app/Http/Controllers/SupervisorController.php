<?php

namespace cardial\Http\Controllers;

use cardial\Supervisor;
use cardial\Usuario;

use Request;
use cardial\Http\Requests\SupervisorRequest;

class SupervisorController extends Controller {

    public function novo() {
        return view('supervisor.form-supervisor');
    }

    public function adiciona(SupervisorRequest $request) {

        // verifica se o usuário já existe
        $login = Request::input('login');
        $usuario = Usuario::all()->where('login', $login)->first();
        if(!empty($usuario) && $usuario->id != null){
            return redirect()
                        ->action('SupervisorController@novo')
                        ->withInput(array('erro' => 'Login já existe'));
        }

        // criando array do supervisor
        $dados_supervisor = array(
                                'nome' => Request::input('nome'),
                                'email' => Request::input('email'),
                                'telefone' => Request::input('telefone'));

        // cadastrando o supervisor
        $supervisor = Supervisor::create($dados_supervisor);

        $usuario = new Usuario();
        $usuario->id = $supervisor->id;
        $usuario->login = strtolower(Request::input('login'));
        $usuario->senha = md5(strtolower(Request::input('login')));

        //salvando no banco de dados
        $usuario->save();

        return redirect()
                        ->action('SupervisorController@listaGeral')
                        ->withInput(array('sucesso' => 'Supervisor cadastro com sucesso'));
    }

    public function mostra($id) {
        $supervisor = Supervisor::find($id);
        return view('supervisor.mostra')->with('supervisor', $supervisor);
    }

    public function edita($id) {
        $supervisor = Supervisor::find($id);
        return view('supervisor.form-editar')->with('supervisor', $supervisor);
    }

    public function altera() {
        $supervisor = Supervisor::find(Request::input('id'));
        $supervisor->nome = Request::input('nome');
        $supervisor->telefone = Request::input('telefone');
        $supervisor->email = Request::input('email');
        $supervisor->save();
        return redirect()
                        ->action('SupervisorController@listaGeral')
                        ->withInput(array('sucesso' => 'Supervisor alterado com sucesso'));
    }

    public function listaGeral() {
        $supervisores = Supervisor::all();
        return view('supervisor.lista-geral')->with('supervisores', $supervisores);
    }

    public function remove($id) {
        $supervisor = Supervisor::find($id);
        $supervisor->delete();

        $usuario = Usuario::find($id);
        $usuario->delete();

        return redirect()
                        ->action('SupervisorController@listaGeral')
                        ->withInput(array('sucesso' => 'Supervisor removido com sucesso'));
    }

}
