@extends('layout.app')
@section('content')
<style>
    .novo-cliente {
        padding-bottom: 20px;
        /*padding-top: 10px;*/
    }
</style>

<div class="container">
    <div class="row novo-vendedor">
        <a href="/vendedor/novo/">
            <button class="btn btn-primary">Novo Vendedor</button>
        </a>
    </div>
    <div class="row">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <td>Nome</td>
                    <td>E-Mail</td>
                    <td>Telefone</td>
                    <td>Supervisor</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($vendedores as $item)
                <tr>
                    <td>{{$item->nome}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->telefone}}</td>
                    <td>{{$item->supervisor->nome}}</td>
                    <td>
                        <a href="{{action('VendedorController@mostra', $item->id)}}">
                            <span class="fa fa-search"></span>
                        </a>
                    </td>
                    <td>
                        <a href="{{action('VendedorController@edita', $item->id)}}">
                            <span class="fa fa-edit">
                            </span></a>
                    </td>
                    <td>
                        <a href="{{action('VendedorController@remove', $item->id)}}">
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