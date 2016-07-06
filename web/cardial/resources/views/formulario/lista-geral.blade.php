@extends('layout.app')
@section('content')
<style>
    .novo-cliente {
        padding-bottom: 20px;
        /*padding-top: 10px;*/
    }
</style>
<div class="row novo-cliente">
    <a href="/formulario/novo/">
        <button class="btn btn-primary">Novo Formulario</button>
    </a>
</div>
<div class="row">
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <td>Descrição</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($formularios as $item)
            <tr>
                <td>{{$item->descricao}}</td>
                <td>
                    <a href="/formulario/novo?{{$item->id}}">
                        <span class="fa fa-edit">
                        </span></a>
                </td>
                <td>
                    <a href="{{action('FormularioController@remove', $item->id)}}">
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