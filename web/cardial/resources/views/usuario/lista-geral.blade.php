@extends('layout.app')
@section('content')
<div class="row">
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <td>Id do Supervisor</td>
                <td>Nome do Supervisor</td>
                <td>E-Mail do Supervisor</td>
                <td>Redefinir Senha</td>
                <td>Redefinir IMEI</td>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nome}}</td>
                <td>{{$item->email}}</td>
                <td>
                    <a href="{{action('ClienteController@senha', $item->id)}}">
                        <span class="fa fa-danger"></span>
                    </a>
                </td>
                <td>
                    <a href="{{action('ClienteController@imei', $item->id)}}">
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