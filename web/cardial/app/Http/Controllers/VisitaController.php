<?php

namespace cardial\Http\Controllers;

use Illuminate\Http\Request;
use cardial\Http\Requests\VisitaBaseRequest;
use cardial\VisitaBase;
use cardial\Visita;
use cardial\Cliente;
use cardial\Vendedor;
use cardial\Supervisor;
use cardial\Resposta;

class VisitaController extends Controller {

    public function novo() {
        $clientes = Cliente::all();
        $supervisores = Supervisor::all();
        $vendedores = Vendedor::all();
        return view('visita.form-visita')
                        ->with('clientes', $clientes)
                        ->with('supervisores', $supervisores)
                        ->with('vendedores', $vendedores);
    }

    public function adiciona(VisitaBaseRequest $request) {
        VisitaBase::create($request->all());
        return redirect()
                        ->action('VisitaController@listaGeral')
                        ->withInput(array('sucesso' => 'Visita base adicionada com sucesso!'));
    }

    public function mostra($id) {
        $visitas = Visita::all()->where('visita_id', intval($id));

        foreach ($visitas as $key => $item) {
            $visitas[$key]->visitaBase = VisitaBase::find($item->visita_id);
            $visitas[$key]->visitaBase->vendedor = Vendedor::find($visitas[$key]->visitaBase->vendedor_id);
            $visitas[$key]->visitaBase->cliente = Cliente::find($visitas[$key]->visitaBase->cliente_id);
            $visitas[$key]->visitaBase->supervisor = Supervisor::find($visitas[$key]->visitaBase->supervisor_id);
        }

        return view('visita.mostra')->with('visitas', $visitas);
    }

    public function relatorio($id) {
        $respostas = Resposta::all()->find($id);
        return view('visita.relatorio')->with('respostas', $respostas);
    }

    public function listaGeral() {
        $visitas = VisitaBase::all();
        foreach ($visitas as $key => $value) {
            $visitas[$key]->vendedor = Vendedor::find($value->vendedor_id);
            $visitas[$key]->supervisor = Supervisor::find($value->supervisor_id);
            $visitas[$key]->cliente = Cliente::find($value->cliente_id);
        }
        return view('visita.lista-geral')
                        ->with('visitas', $visitas);
    }

}
