@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <b>Tipo de Cliente: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->tipo_cliente}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <b>Razão Social / Nome Completo: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->razao_social}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <b>CPF / CNPJ: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->cpf_cnpj}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <b>Inscrição Estadual: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->inscricao_estadual}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <b>Nome Fantasia / Apelido: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->nome_fantasia}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <b>CEP: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->cep}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <b>Logradouro: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->logradouro}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <b>Bairro: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->bairro}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <b>Cidade: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->cidade}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <b>UF: </b>
    </div>
    <div class="col-lg-8">
        {{$cliente->uf}}
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <a href="/cliente/lista-geral/"><button class="btn btn-default">Voltar</button></a>
    </div>
    <div class="col-lg-8">
        <a href=""><button class="btn btn-danger">Remover</button></a>
    </div>
</div>
@endsection