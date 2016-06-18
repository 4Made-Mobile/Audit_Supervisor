<?php

namespace cardial\Http\Controllers;

use Request;
use cardial\Vendedor;
use cardial\Supervisor;
use cardial\Http\Requests\VendedorRequest;

class VendedorController extends Controller {

    public function novo() {
        return view('vendedor.form-vendedor')
                        ->with('supervisores', Supervisor::all());
    }

    public function adiciona(VendedorRequest $request) {
        Vendedor::create($request->all());
        return redirect()
                        ->action('VendedorController@listaGeral')
                        ->withInput(array('sucesso' => 'Vendedor adicionado com sucesso'));
    }

    public function listaGeral() {
        $vendedores = Vendedor::all();
        return view('vendedor.lista-geral')->with('vendedores', $vendedores);
    }

    public function edita($id) {
        $vendedor = Vendedor::find($id);
        return view('vendedor.form-editar')
                        ->with('vendedor', $vendedor)
                        ->with('supervisores', Supervisor::all());
    }

    public function altera() {
        $vendedor = Vendedor::find(Request::input('id'));
        $vendedor->nome = Request::input('nome');
        $vendedor->email = Request::input('email');
        $vendedor->telefone = Request::input('telefone');
        $vendedor->supervisor_id = Request::input('supervisor');
        $vendedor->save();
        return redirect()
                        ->action('VendedorController@listaGeral')
                        ->withInput(array('sucesso' => 'Vendedor alterado com sucesso'));
    }

    public function mostra($id) {
        $vendedor = Vendedor::find($id);
        return view('vendedor.mostra')
                        ->with('vendedor', $vendedor);
    }

    public function remove($id) {
        $vendedor = Vendedor::find($id);
        $vendedor->delete();
        return redirect()
                        ->action('VendedorController@listaGeral')
                        ->withInput(array('sucesso' => 'Vendedor removido com sucesso'));
    }

}
