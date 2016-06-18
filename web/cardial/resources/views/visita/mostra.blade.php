@extends('layout.app')
@section('content')
<style>
    .novo{
        padding-bottom: 20px;
    }
</style>

<div class="container">
    <div class="row">
        <h1></h1>
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <td>Supervisor</td>
                    <td>Vendedor</td>
                    <td>Data estimada</td>
                    <td>Data final</td>
                    <td>Situação</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($visitas as $item)
                <?php
                $tipo_visita = $item->situacao == 'ATRASADO' ? "class='danger'" : "";
                ?>
                <tr <?php echo $tipo_visita ?>>
                    <td>{{$item->visitaBase->supervisor->nome}}</td>
                    <td>{{$item->visitaBase->vendedor->nome}}</td>
                    <td>{{$item->data_inicial}}</td>
                    <td>{{$item->data_final}}</td>
                    <td>{{$item->situacao}}</td>
                    <td><i class="fa fa-wpforms"></i></td>
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