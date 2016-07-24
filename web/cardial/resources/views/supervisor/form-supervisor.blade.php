@extends('layout.app')
@section('content')
<div class="row">
    <h1 class="center-block">Cadastro de Supervisor</h1>

    <form method="POST" action="/supervisor/adiciona" autocomplete="off">
        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" id="nome"
                   required pattern="[\w ]+">
        </div>

        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" name="login" class="form-control" id="login"
                   required pattern="[\w]+">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email"
                   required pattern="[\w-\._@]+">
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control" id="telefone"
                   required pattern="[\d ()-]+">
        </div>

        <br>

        <div class="from-group">
            <button type="submit" class="btn btn-clean">Cadastrar</button>
            <a href="/supervisor/lista-geral/">
                <button class="btn btn-primary">
                    Voltar
                </button>
            </a>
        </div>
        <br>
    </form>
</div>

@endsection