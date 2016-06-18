@extends('layout.app')
@section('content')
<div class="container">
    <div class="row">
        <h1 class="center-block">Alterar Pergunta</h1>

        <form method="POST" action="/pergunta/adiciona" autocomplete="off">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" name="descrição" class="form-control" id="descrição"
                       required pattern="[\w ]+">
            </div>

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo">
                    <option value="OBJETIVA">1 a 10</option>
                    <option value="AFIRMARTIVA">Sim ou não</option>
                    <option value="DESCRITIVA">Descritiva</option>
                </select>
            </div>

            <div class="form-group">
                <label for="obrigatoria">Obrigatória</label>
                <input type="radio" value="S" type="text" name="obrigatoria" id="obrigatoria">Sim
                <input type="radio" value="N" type="text" name="obrigatoria" id="obrigatoria">Não
            </div>

            <div class="form-group">
                <label for="">Grupo</label>
                <select name="ordem">
                    <option value="1">Grupo 1</option>
                    <option value="2">Grupo 2</option>
                    <option value="3">Grupo 3</option>
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