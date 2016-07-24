@extends('layout.app')
@section('content')
<div class="row">
    <h1> <b>Lista do Feedback</b> </h1>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <td>Data da Visita</td>
                <td>Supervisor</td>
                <td>Vendedor</td>
                @foreach($perguntas as $item)
                <td>
                    {{$item['descricao']}}
                </td>
                @endforeach
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($visitas as $item)
            <tr>
                <td>{{$item['data_final']}}</td>
                <td>{{$item['supervisor']}}</td>
                <td>{{$item['vendedor']}}</td>
                @foreach($item['respostas'] AS $resposta)
                    <td>{{$resposta->descricao}}</td>
                @endforeach
                <!-- <td><a href='#'>Detalhes</a></td> -->
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

@endsection
@include('layout.scripts')