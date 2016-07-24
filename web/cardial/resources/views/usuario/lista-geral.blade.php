@extends('layout.app')
@section('content')
<div class="row">
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <td>Id</td>
                <td>Supervisor</td>
                <td>Login</td>
                <td>Redefinir IMEI</td>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->supervisor->nome}}</td>
                <td>{{$item->login}}</td>
                <td>
                    <a href="{{action('UsuarioController@imei', $item->id)}}">
                        <span class="fa fa-key"></span>
                    </a>
                </td>
                <td>
                    <a href="{{action('UsuarioController@edita', $item->id)}}">
                        <span class="fa fa-edit"></span>
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