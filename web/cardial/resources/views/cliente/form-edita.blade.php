@extends('layout.app')
@section('content')

<?php
if ($cliente->tipo_cliente == "J") {
    $cliente_juridico = "checked='checked'";
    $cliente_fisico = "";
} else {
    $cliente_juridico = "";
    $cliente_fisico = "checked='checked'";
}
?>

<div class="container">
    <div class="row">
        <h1 class="center-block">Cadastro de Cliente</h1>

        <form method="POST" action="/cliente/altera" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{$cliente->id}}">

            <div class="form-group">
                <input type="radio" <?= $cliente_juridico ?> value="J" name="tipo_cliente" id="tipo_cliente"/>Pessoa
                Juridica
                <input type="radio" <?= $cliente_fisico ?> value="F" name="tipo_cliente" id="tipo_cliente"/>Pessoa
                Fisica
            </div>

            <div class="form-group">
                <label for="razao_social">Nome Completo / Razao Social</label>
                <input type="text" name="razao_social" class="form-control" id="razao_social"
                       required pattern="[\w \.-+\?]+" value="{{$cliente->razao_social}}">
            </div>

            <div class="form-group">
                <label for="cpf_cnpj">CPF/CNPJ</label>
                <input type="text" name="cpf_cnpj" class="form-control" id="cpf_cnpj"
                       required pattern="[\d]{3}\.?[\d]{3}\.?[\d]{3}-?[\d]{2}+" value="{{$cliente->cpf_cnpj}}">
            </div>

            <div class="form-group">
                <label for="cpf_cnpj">CEP</label>
                <input type="text" name="cep" class="form-control" id="cep"
                       required pattern="[\d -]+" value="{{$cliente->cep}}">
            </div>

            <div class="form-group">
                <label for="inscricao_estadual">Inscricao Estadual</label>
                <input type="text" name="inscricao_estadual" class="form-control" id="inscricao_estadual"
                       required pattern="[\d -\.x]+" value="{{$cliente->inscricao_estadual}}">
            </div>

            <div class="form-group">
                <label for="nome_fantasia">Nome Fantasia</label>
                <input type="text" name="nome_fantasia" class="form-control" id="nome_fantasia"
                       required pattern="[\w -]+" value="{{$cliente->nome_fantasia}}">
            </div>

            <div class="form-group">
                <label for="logradouro">Logradouro</label>
                <input type="text" name="logradouro" class="form-control" id="logradouro"
                       required pattern="[\w -\.]+" value="{{$cliente->logradouro}}">
            </div>

            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" class="form-control" id="bairro"
                       required pattern="[\w -]+" value="{{$cliente->bairro}}">
            </div>

            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" class="form-control" id="cidade"
                       required pattern="[\w -]+" value="{{$cliente->cidade}}">
            </div>

            <div class="from-group">
                <label for="telefone">UF</label>
                <input type="text" name="uf" class="form-control" id="uf"
                       required pattern="\w{2}" value="{{$cliente->uf}}">
            </div>
            <br>

            <div class="from-group">
                <button type="submit" class="btn btn-clean">Alterar</button>
                <a href="/cliente/lista-geral/">
                    <button class="btn btn-primary">
                        Voltar
                    </button>
                </a>
            </div>
            <br>
        </form>
    </div>
</div>

@endsection