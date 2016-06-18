@extends('layout.app')
@section('content')
<div class="container">
    <div class="row">
        <h1 class="center-block">Cadastro de Visita Base</h1>

        <form method="POST" action="/visita/adiciona" autocomplete="off">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
                <label for="nome">Data base</label>
                <input type="date" name="data_base" class="form-control" id="data_base"
                       required="true">
            </div>

            <div class="form-group">
                <label for="email">Frequencia</label>
                <input type="text" name="frequencia" class="form-control" id="frequencia"
                       required pattern="[\d][\d]+">
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

            <div class="form-group">
                <label>Vendedor</label>
                <select name="vendedor_id" class="form-control">
                    <option>seleciona um vendedor</option>
                    @foreach($vendedores as $item)
                    <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Cliente</label>
                <select name="cliente_id" class="form-control">
                    <option>seleciona um cliente</option>
                    @foreach($clientes as $item)
                    <option value="{{$item->id}}">{{$item->nome_fantasia}}</option>
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