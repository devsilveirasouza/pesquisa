@extends('adminlte::page')
{{-- Configuração do datatables --}}
@php
// Definindo cabeçalho do datatables
$heads = [
    'ID',
    'Nome.',
    'Email', // opção de botões removida temporariamente
];
// Rota do processamento ajax
$url = 'usuarios/ajax';
// configuração geral do processamento  dos dados
$config = [
    'language' => [
        'url' => 'datatables_translates/pt-BR.json', // Tradução
    ],
    'processing' => true,
    'serverSide' => true,
    'searching' => true,
    'ordering' => true,
    'ajax' => $url,
    'sDom' => 'lprit', // Configuração: 'DOM' de exibição do datatable
    'columns' => [
        ['data' => 'id'],
        ['data' => 'name'],
        ['data' => 'email'], // opção de botões removida temporariamente
    ],
];

@endphp

@section('title', 'Users List')

@section('content_header')
    <h1>Listagem de Usuários</h1>
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif
@stop

@section('content')

    <x-adminlte-datatable id="consulta" :heads="$heads" :config="$config" striped hoverable bordered compressed />

@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Datatables jquery CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

@stop

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();

                var pageNumber = $(this).attr('href').split('page=')[1];
                $("#hidden_page").val(pageNumber);
                getMorePage(pageNumber)
            });

            function getMorePage(pageNumber) {
                @if (session('pageview') == 'true')
                    {}
                @endif
            }
        });
    </script>
@endpush

@section('js')
    <!-- Datatables jquery 3.6.0 js -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Datatables jquery min js -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

@stop
