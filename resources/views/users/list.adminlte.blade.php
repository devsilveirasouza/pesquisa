@extends('adminlte::page')
<!-- Ajustando o dataTable com CSS -->
<style type="text/css">
    table.consulta  {
        margin-bottom: 0px !important;
        margin-top: 0px !important;
        border-collapse: collapse !important;
    }
</style>
{{-- Configuração do datatables --}}
{{-- Setup data for datatables --}}
@php
$heads = [
    'ID',
    'Name',
    ['label' => 'Phone', 'width' => 40],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
$btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

$config = [
    'language' => [ 'url' => 'datatables_translates/pt-BR.json', ], // Tradução
    'data' => [
        [$user->'id', 'John Bender', '+02 (123) 123456789', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
        [19, 'Sophia Clemens', '+99 (987) 987654321', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
        [3, 'Peter Sousa', '+69 (555) 12367345243', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
    ],
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp
{{-- @php
// Definindo cabeçalho do datatables
$heads = [
    'ID',
    'Nome.',
    'Email',
    //'Ações',
    ];
// Rota do processamento ajax
$url = route('user.listAll');
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
    'sDom' => 'blfrtip', // Configuração: 'DOM' de exibição do datatable
    'columns' => [
        ['data' => 'id'],
        ['data' => 'name'],
        ['data' => 'email', 'orderable' => false],
        //['data' => 'buttons', 'orderable' => false, 'no-export' => true, 'width' => 5],
    ],
];
@endphp --}}

@section('title', 'Users List')

@section('content_header')
    <h2>Usuários Cadastrados</h2>
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif
@stop

@section('content')
    <x-adminlte-datatable id="consulta" :heads="$heads" :config="$config" striped hoverable bordered compressed />
@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Datatables jquery CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

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
