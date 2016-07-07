@extends('layout.app')
@section('content')
<style>
    .novo-cliente {
        padding-bottom: 20px;
        /*padding-top: 10px;*/
    }
</style>
<form action="/formulario/adiciona/">
    <div class="row">           
        <input type="hidden" value="" id="id-formulario" /> 
        <div class="col-lg-2">
            <label for="nome-formulario"><p class="center"><h4>Nome do Formulário</h4></p></label>
        </div>
        <div class="col-lg-6">
            <input value="" class="form-control" id="nome-formulario" name="descricao" type="text"/>
        </div>
        <div class="col-lg-1">
            <input class="btn btn-primary" type="submit" value="Adicionar"/>
        </div>
    </div>
</form>
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
                    <a href="/formulario/novo?id={{$item->id}}">
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