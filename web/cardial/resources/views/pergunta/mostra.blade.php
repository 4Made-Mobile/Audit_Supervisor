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
            <b>Descrição: </b>
        </div>
        <div class="col-lg-8">
            {{$pergunta->descricao}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <b>Tipo: </b>
        </div>
        <div class="col-lg-8">
            {{$pergunta->tipo}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <b>Obrigatória: </b>
        </div>
        <div class="col-lg-8">
            <?php
            $obrigatoria = $pergunta->obrigatoria == 'S';
            if ($obrigatoria) {
                echo "SIM";
            } else {
                echo "NÃO";
            }
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <b>Tipo: </b>
        </div>
        <div class="col-lg-8">
            <?php
            $visivel = $pergunta->visivel == 'S';
            if ($visivel) {
                echo "SIM";
            } else {
                echo "NÃO";
            }
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <b>Tipo: </b>
        </div>
        <div class="col-lg-8">
            {{$pergunta->tipo}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <a href="/pergunta/lista-geral/"><button class="btn btn-default">Voltar</button></a>
        </div>
        <div class="col-lg-8">
            <a href=""><button class="btn btn-danger">Remover</button></a>
        </div>
    </div>
</div>
@endsection