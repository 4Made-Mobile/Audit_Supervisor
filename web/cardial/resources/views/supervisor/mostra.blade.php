@extends('layout.app')
@section('content')
<style>
    .row{
        padding-bottom: 5%;
    }
</style>
<div class="container">

    <div class="row">
        <div class="col-lg-4">
            <b>Nome Completo: </b>
        </div>
        <div class="col-lg-8">
            {{$supervisor->nome}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <b>E-Mail: </b>
        </div>
        <div class="col-lg-8">
            {{$supervisor->email}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <b>Telefone: </b>
        </div>
        <div class="col-lg-8">
            {{$supervisor->telefone}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <a href="/supervisor/lista-geral/"><button class="btn btn-default">Voltar</button></a>
        </div>
        <div class="col-lg-8">
            <a href=""><button class="btn btn-danger">Remover</button></a>
        </div>
    </div>
</div>
@endsection