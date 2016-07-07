<?php

namespace cardial\Http\Controllers;

use cardial\Http\Requests\PerguntaRequest;
use cardial\Pergunta;
use cardial\Formulario;
use cardial\PerguntaFormulario;
use Request;

class FormularioController extends Controller {

    public function novo()
    {
        $id_formulario = "";
        $descricao = "";
        if(empty(Request::input('id')))
            return redirect()
                    ->action('FormularioController@listaGeral')
                    ->withInput(array('sucesso' => 'formulairo removido com sucesso'));

        $id_formulario = Request::input('id'); 
        $formulario = Formulario::find(intval($id_formulario));
        if(!empty($formulario->descricao) && $id_formulario != 0)
            $descricao = $formulario->descricao;

        return view('formulario.form-novo')
                                        ->with('id_formulario', $id_formulario)
                                        ->with('descricao', $descricao);
    }

    public function adiciona(){
        $descricao = Request::input("descricao");
        if(!empty($descricao))
            Formulario::create(array('descricao' => $descricao));

        return redirect()
                    ->action('FormularioController@listaGeral')
                    ->withInput(array('sucesso' => 'formulairo removido com sucesso'));
    }

    public function criaFormulario(){
        $nome_formulario = Request::input('nome_formulario');
        $formulario = Formulario::create(array(
                                            'descricao' => $nome_formulario 
                                              ));
        return json_enconde($formulario->id);
    }

    public function finalizar()
    {
    	if(empty($_GET['id_formulario']) && $_GET['id_formulario'] != '0')
    		return json_encode("erooou!");

    	return json_encode("acertou");
    }

    public function removePergunta(){

        $id_pergunta = Request::input('id');
        $pergunta = Pergunta::find(intval($id_pergunta));
        $pergunta_formulario = PerguntaFormulario::find(intval($id_pergunta));
        if(empty($pergunta) || empty($pergunta_formulario))
                return json_encode("false");

        $pergunta->delete();
        $pergunta_formulario->delete();
        return json_enconde("true");
    }

    public function listaPergunta(){
        $id_formulario = Request::input('id');

        if(empty($id_formulario))
            return json_encode();

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

    public function alteraFormulario(){
        $id = Request::input('id');
        $descricao = Request::input('nome_formulario');

        $formulario = Formulario::find(intval($id));
        $formulario->descricao = $descricao;
        $formulario->save();

        return json_enconde("true");
    }

    public function criaPergunta(){
        $dados = Request::input('dados');
        $dados_pergunta = array(
            'descricao' => $dados[0],
            'tipo' => $dados[3],
            'visivel' => $dados[1],
            'ordem' => $dados[2],
            );

        $pergunta = Pergunta::create($dados_pergunta);

        $id_formulario = $dados[4];
        $id_pergunta = $pergunta->id;

        PerguntaFormulario::create(array(
                'pergunta_id' => $id_pergunta,
                'formulario_id' => $id_formulario,
            ));

        return json_encode("true");
    }

    public function listaGeral(){
        $formularios = Formulario::where('id', '>', 0)->get();
        return view('formulario.lista-geral')->with('formularios', $formularios);
    }

    public function remove($id) {
        $formulario = Formulario::find(intval($id));
        PerguntaFormulario::where('formulario_id',$id)->delete();
            
        
        $formulario->delete();

        return redirect()->action('FormularioController@listaGeral');
    }   
    
}