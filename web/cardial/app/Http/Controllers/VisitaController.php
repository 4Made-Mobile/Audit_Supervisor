<?php

namespace cardial\Http\Controllers;

use cardial\Http\Requests\VisitaBaseRequest;
use Request;
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
        
        // primeiro pega todas perguntas do formulário
        $perguntas = VisitaBase::
                        join('formulario', 'visita_base.formulario_id', '=', 'formulario.id')->
                        join('pergunta_formulario', 'formulario.id', '=', 'pergunta_formulario.formulario_id')->
                        join('pergunta', 'pergunta_formulario.pergunta_id', '=', 'pergunta.id')->
                        select('pergunta.descricao')->
                        get();

        // agora pega o nome do supervisor, vendedor e a data de todas as visitas
        $visitas = VisitaBase::
                        join('supervisor', 'visita_base.supervisor_id', '=', 'supervisor.id')->
                        join('vendedor', 'visita_base.vendedor_id', '=', 'vendedor.id')->
                        join('cliente', 'visita_base.cliente_id', '=', 'cliente.id')->
                        join('visita', 'visita_base.id', '=', 'visita.visita_id')->
                        select('supervisor.nome AS supervisor',
                               'vendedor.nome AS vendedor',
                               'cliente.razao_social AS cliente',
                               'visita.data_final',
                               'visita.id')->
                        where('visita.situacao','=' ,'CONCLUIDO')->
                        where('visita.data_inicial', '<', date('Y-m-d', strtotime("+1 days")))->
                        get();

        $cliente = $visitas[0]['cliente'];

        foreach ($visitas as $key => $value) {
            $respostas = Resposta::all()->where('visita_id',$value['id']);
            $visitas[$key]['respostas'] = $respostas;
        }

        return view('visita.mostra')
                        ->with('perguntas', $perguntas)
                        ->with('visitas', $visitas)
                        ->with('cliente', $cliente);
    }

    public function relatorio($id) {
        $respostas = Resposta::all()->find($id);
        return view('visita.relatorio')->with('respostas', $respostas);
    }

    public function listaGeral() {
        $supervisor_id = Request::input('supervisor');
        $vendedor_id = Request::input('vendedor');
        $cliente_id = Request::input('cliente');


        // No lugar dos IFs usar design patters. É melhor pro compilador amiguinhos ;)
        // E melhora o código
        if (!empty($supervisor_id) && empty($vendedor_id) && empty($cliente_id)) {
            $visitas = VisitaBase::all()->where('supervisor_id', $supervisor_id);
        } else if (!empty($supervisor_id) && !empty($vendedor_id) && empty($cliente_id)) {
            $visitas = VisitaBase::all()->where('supervisor_id', $supervisor_id)->where('vendedor_id', $vendedor_id);
        } else if (!empty($supervisor_id) && !empty($vendedor_id) && !empty($cliente_id)) {
            $visitas = VisitaBase::all()->where('supervisor_id', $supervisor_id)->where('vendedor_id', $vendedor_id)->where('cliente_id', $cliente_id);
        } else {
            $visitas = VisitaBase::all();
        }

        foreach ($visitas as $key => $value) {
            $visitas[$key]->vendedor = Vendedor::find($value->vendedor_id);
            $visitas[$key]->supervisor = Supervisor::find($value->supervisor_id);
            $visitas[$key]->cliente = Cliente::find($value->cliente_id);
        }
        return view('visita.lista-geral')
                        ->with('visitas', $visitas)
                        ->with('supervisores', Supervisor::all())
                        ->with('vendedores', Vendedor::all())
                        ->with('clientes', Cliente::all());
    }

}
