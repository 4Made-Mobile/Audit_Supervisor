@extends('layout.app')
@section('content')
<style>
    .novo-cliente {
        padding-bottom: 20px;
        /*padding-top: 10px;*/
    }
</style>

<div class="container">
    <div class="row novo">
        <a href="/visita/novo/">
            <button class="btn btn-primary">Nova Visita Base</button>
        </a>
    </div>
    <br/>
    <div class="row">
        <select name="supervisor_id">
            <option value="" selected="true"> --Selecione Supervisor-- </option>
            @foreach($supervisores as $item)
            <option value="{{$item->id}}">{{$item->nome}}</option>
            @endforeach
        </select>

        <select name="vendedor_id">
            <option value="" selected="true"> --Selecione Vendedor-- </option>
            @foreach($vendedores as $item)
            <option value="{{$item->id}}">{{$item->nome}}</option>
            @endforeach
        </select>

        <select name="cliente_id">
            <option value="" selected="true"> --Selecione Clientes -- </option>
            @foreach($clientes as $item)
            <option value="{{$item->id}}">{{$item->razao_social}}</option>
            @endforeach
        </select>

        <a href="/visita/novo">
            <button>Pesquisar</button>
        </a>
    </div>
    <br/>
    <div class="row">
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <td>Cliente</td>
                    <td>Vendedor</td>
                    <td>Supervisor</td>
                    <td>Frequência</td>
                    <td>Data base</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($visitas as $item)
                <tr>
                    <td>{{$item->cliente->nome_fantasia}}</td>
                    <td>{{$item->vendedor->nome}}</td>
                    <td>{{$item->supervisor->nome}}</td>
                    <td>{{$item->frequencia}}</td>
                    <td>{{$item->data_base}}</td>
                    <td>
                        <a href="{{action('VisitaController@mostra', $item->id)}}">
                            <span class="fa fa-search"></span>
                        </a>
                    </td>
                    <td>
                        <a href="{{action('VisitaController@remove', $item->id)}}">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
</div>
@endsection
@include('layout.scripts')