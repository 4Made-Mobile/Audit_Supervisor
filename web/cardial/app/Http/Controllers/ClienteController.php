<?php

namespace cardial\Http\Controllers;

use Request;
use cardial\Cliente;
use cardial\Http\Requests\ClienteRequest;

class ClienteController extends Controller {

    public function novo() {
        return view('cliente.form-cliente');
    }

    public function adiciona(ClienteRequest $request) {
        Cliente::create($request->all());
        return redirect()->action('ClienteController@listaGeral')->withInput(array('sucesso' => 'Cliente adicionado com sucesso'));
    }

    public function mostra($id) {
        if (empty($id)) {
            return redirect()->action('ClienteController@lista-geral')->withInput(array('erro' => 'Id não encontrado'));
        }
        $cliente = Cliente::find($id);
        return view('cliente.mostra')->with('cliente', $cliente);
    }

    public function edita($id) {
        $cliente = Cliente::find($id);
        if (empty($cliente)) {
            return redirect()
                            ->action('ClienteController@listaGeral')
                            ->withInput(array('erro' => "Não existe este ID"));
        }
        return view('cliente.form-edita')->with('cliente', $cliente);
    }

    public function altera() {
        $cliente = Cliente::find(Request::input('id'));
        $cliente->tipo_cliente = Request::input('tipo_cliente');
        $cliente->razao_social = Request::input('razao_social');
        $cliente->cpf_cnpj = Request::input('cpf_cnpj');
        $cliente->inscricao_estadual = Request::input('inscricao_estadual');
        $cliente->nome_fantasia = Request::input('nome_fantasia');
        $cliente->cep = Request::input('cep');
        $cliente->logradouro = Request::input('logradouro');
        $cliente->bairro = Request::input('bairro');
        $cliente->cidade = Request::input('cidade');
        $cliente->uf = Request::input('uf');

        $cliente->save();
        return redirect()
                        ->action('ClienteController@listaGeral')
                        ->withInput(array('sucesso' => 'Cliente alterado com sucesso'));
    }

    public function remove($id) {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()
                        ->action('ClienteController@listaGeral')
                        ->withInput(array('sucesso' => 'cliente removido com sucesso'));
    }

    public function listaGeral() {
        $clientes = Cliente::all();
        return view('cliente.lista-geral')->with('clientes', $clientes);
    }

}
