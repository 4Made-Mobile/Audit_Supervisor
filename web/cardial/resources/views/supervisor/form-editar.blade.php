@extends('layout.app')
@section('content')
<div class="container">
    <div class="row">
        <h1 class="center-block">Alteração de Supervisor</h1>

        <form method="POST" action="/supervisor/altera" autocomplete="off">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" value="{{$supervisor->id}}">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" id="nome"
                       value="{{$supervisor->nome}}" required pattern="[\w ]+">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email"
                       value="{{$supervisor->email}}" required pattern="[\w-\._@]+">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" class="form-control" id="telefone"
                       value="{{$supervisor->telefone}}" required pattern="[\d ()-]+">
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