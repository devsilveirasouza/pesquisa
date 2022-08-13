@extends('adminlte::page')
<!-- Ajustando o dataTable com CSS -->
<style type="text/css">
    table.consulta {
        margin-bottom: 0px !important;
        margin-top: 0px !important;
        border-collapse: collapse !important;
    }
</style>
{{-- Configuração do datatables --}}
@php
// Definindo cabeçalho do datatables
$heads = ['ID', 'Nome', 'Email', 'Ações'];
// Rota do processamento ajax
$url = route('user.listAll');
// configuração geral do processamento dos dados
$config = [
    'language' => [
        'url' => 'datatables_translates/pt-BR.json', // Tradução
    ],
    'processing' => true,
    'serverSide' => true,
    'searching' => true,
    'ordering' => true,
    'ajax' => $url,
    'sDom' => 'blfrtip', // Configuração: 'DOM' de exibição do datatable
    'columns' => [['data' => 'id'], ['data' => 'name'], ['data' => 'email', 'orderable' => false], ['data' => 'buttons', 'orderable' => false, 'no-export' => true, 'width' => 5]],
];
@endphp

@section('title', 'Users List')

@section('content_header')

    <div id="success_message">
        @if ($status = Session::get('mensagem'))
            <h4> {{ $status }} </h4>
        @endif
    </div>

@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="car-header">
                        <h4 class="text-left mt-3 mb-2 ml-3">Dados dos usuários
                            <a href="{{ route('user.create') }}"
                                class="btn btn-primary float-end btn-sm mt-2 mb-2 mr-3 add_user">Cadastrar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <x-adminlte-datatable id="consulta" class="consulta_table" :heads="$heads" :config="$config"
                            striped hoverable bordered compressed />
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datatables jquery CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('js')
    <!-- SweetAlert -->
    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('js/jquery-3.6.0.min.js') }} "></script>
    {{-- Scripts Users --}}
    <script src=" {{ asset('site/user.js') }} "></script>
    <!-- Datatables jquery min js -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

@stop