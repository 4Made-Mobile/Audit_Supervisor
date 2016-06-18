@extends('layout.app')
@section('content')
<div class="container">
    <div class="row">
        <h1 class="center-block">Cadastro de Vendedor</h1>

        <form method="POST" action="/vendedor/adiciona" autocomplete="off">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" id="nome"
                       required pattern="[\w ]+">
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

            <div class="form-group">
                <label>Supervisor</label>
                <select name="supervisor_id" class="form-control">
                    <option>seleciona um supervisor</option>
                    @foreach($supervisores as $item)
                    <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
            </div>

            <br>

            <div class="from-group">
                <button type="submit" class="btn btn-clean">Cadastrar</button>
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