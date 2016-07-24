@extends('layout.app')
@section('content')

<div class="row novo-supervisor">
    <a href="/supervisor/novo/">
        <button class="btn btn-primary">Novo Supervisor</button>
    </a>
</div>
<div class="row">
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <td>Nome</td>
                <td>E-Mail</td>
                <td>Telefone</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($supervisores as $item)
            <tr>
                <td>{{$item->nome}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->telefone}}</td>
                <td>
                    <a href="{{action('SupervisorController@mostra', $item->id)}}">
                        <span class="fa fa-search"></span>
                    </a>
                </td>
                <td>
                    <a href="{{action('SupervisorController@edita', $item->id)}}">
                        <span class="fa fa-edit">
                        </span></a>
                </td>
                <td>
                    <a href="{{action('SupervisorController@remove', $item->id)}}">
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
    
@endsection
@include('layout.scripts')