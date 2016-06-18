@extends('layout.app')
@section('content')
<style>
    .novo-cliente {
        padding-bottom: 20px;
        /*padding-top: 10px;*/
    }
</style>

<div class="container">
    <div class="row novo-cliente">
        <a href="/cliente/novo/">
            <button class="btn btn-primary">Novo Cliente</button>
        </a>
    </div>
    <div class="row">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <td>CPF</td>
                    <td>Razao Social / Nome</td>
                    <td>Nome / Nome Fantasia</td>
                    <td>Logradouro</td>
                    <td>Bairro</td>
                    <td>Cidade</td>
                    <td>UF</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $item)
                <tr>
                    <td>{{$item->cpf_cnpj}}</td>
                    <td>{{$item->razao_social}}</td>
                    <td>{{$item->nome_fantasia}}</td>
                    <td>{{$item->logradouro}}</td>
                    <td>{{$item->bairro}}</td>
                    <td>{{$item->cidade}}</td>
                    <td>{{$item->uf}}</td>
                    <td>
                        <a href="{{action('ClienteController@mostra', $item->id)}}">
                            <span class="fa fa-search"></span>
                        </a>
                    </td>
                    <td>
                        <a href="{{action('ClienteController@edita', $item->id)}}">
                            <span class="fa fa-edit">
                            </span></a>
                    </td>
                    <td>
                        <a href="{{action('ClienteController@remove', $item->id)}}">
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