@extends('layout.app')
@section('content')
<style>
    .novo{
        padding-bottom: 20px;
        /*padding-top: 10px;*/
    }
</style>

<div class="container">
    <div class="row novo-supervisor">
        <a href="/pergunta/novo/">
            <button class="btn btn-primary">Nova Pergunta</button>
        </a>
    </div>
    <div class="row">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <td>Descrição</td>
                    <td>Tipo</td>
                    <td>Obrigatória</td>
                    <td>Visível</td>
                    <td>Grupo</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($perguntas as $item)
                <tr>
                    <td>{{$item->descricao}}</td>
                    <td>{{$item->tipo}}</td>
                    <td>{{$item->obrigatoria}}</td>
                    <td>{{$item->visivel}}</td>
                    <td>{{$item->ordem}}</td>
                    <td>
                        <a href="{{action('PerguntaController@mostra', $item->id)}}">
                            <span class="fa fa-search"></span>
                        </a>
                    </td>
                    <td>
                        <a href="{{action('PerguntaController@edita', $item->id)}}">
                            <span class="fa fa-edit">
                            </span></a>
                    </td>
                    <td>
                        <a href="{{action('PerguntaController@remove', $item->id)}}">
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
</div>
@endsection
@include('layout.scripts')