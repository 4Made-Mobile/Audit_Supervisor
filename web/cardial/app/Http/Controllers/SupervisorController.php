<?php

namespace cardial\Http\Controllers;

use cardial\Supervisor;
use Request;
use cardial\Http\Requests\SupervisorRequest;

class SupervisorController extends Controller {

    public function novo() {
        return view('supervisor.form-supervisor');
    }

    public function adiciona(SupervisorRequest $request) {
        Supervisor::create($request->all());
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
        return redirect()
                        ->action('SupervisorController@listaGeral')
                        ->withInput(array('sucesso' => 'Supervisor removido com sucesso'));
    }

}
