<?php

namespace cardial\Http\Controllers;

use cardial\Http\Requests\PerguntaRequest;
use cardial\Pergunta;

class PerguntaController extends Controller {

    public function novo() {
        return view('pergunta.form-pergunta');
    }

    public function adiciona(PerguntaRequest $request) {
        Pergunta::create($request->all());
        return redirect()
                        ->action('PerguntaController@listaGeral')
                        ->withInput(array('sucesso' => 'Pergunta adicionada com sucesso'));
    }

    public function listaGeral() {
        $perguntas = Pergunta::all();
        return view('pergunta.lista-geral')
                        ->with('perguntas', $perguntas);
    }

    public function mostra($id) {
        $pergunta = Pergunta::find($id);
        return view('pergunta.mostra')
                        ->with('pergunta', $pergunta);
    }

    public function edita($id) {
        $pergunta = Pergunta::find($id);
        return view('pergunta.form-editar')
                        ->with('pergunta', $pergunta);
    }

    public function altera() {
        $pergunta = Pergunta::find(request::find('id'));
        $pergunta->descricao = request::find('descricao');
        $pergunta->tipo = request::find('tipo');
        $pergunta->obrigatoria = request::find('obrigatoria');
        $pergunta->visivel = request::find('visivel');
        $pergunta->ordem = request::find('ordem');
        $pergunta->save();

        return redirect()
                        ->action('PerguntaController@listaGeral')
                        ->withInput(array('sucesso' => 'Pergunta alterada com sucesso'));
    }

    public function remove($id) {
        $pergunta = Pergunta::find($id);
        $pergunta->delete();
        return redirect()
                        ->action('PerguntaController@listaGeral')
                        ->withInput(array('sucesso' => 'Pergunta removida com sucesso'));
    }

}
