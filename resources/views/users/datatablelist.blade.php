@extends('adminlte::page')
{{-- Setup data for datatables --}}
{{-- Setup data for datatables --}}
@php
// Definindo cabeçalho - Título das colunas - ok 01/05/2022 //
$heads = [
    'ID',
    'Nome.',
    'Email',
];
// Rota de busca das informações - ok 01/05/2022 //
$url = route('users.datatablelist');
// configuração geral em desenvolvimento ...
$config = [
    // Tradução via cdn - ok 01/05/2022 //
    'language'  => [
        'url'   => 'datatables_translates/pt-BR.json',
    ],
    // Em desenvolvimento - 05/05/2022
    'processing'    => true,
    'serverSide'    => true,
    'searching'     => true,
    'ordering'      => false,
    'ajax'          => $url,
    'sDom'          => 'lrtip', // Remover busca geral
    'columns'       => [
        ['data' =>    'id',      'user' => 'id'],
        ['data' =>    'name',    'user' => 'nome'],
        ['data' =>    'email',   'user' => 'email'],
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

@stop

@section('js')

<script>
    $( function () {
        $('#consulta').Datatable({
            "oLanguage"     : {
                "sProcessing"   : "<span>Please wait...</span>"
            },
            "pagingType"    : "simple_numbers",
            "paging"        : true,
            "lengthMenu"    : [
                [ 10, 25, 50 ],
                [ 10, 25, 50 ]
            ],
            "processing"    : true,
            "serverSide"    : true,
            "ordering"      : false,
            "ajax"          : {
                "type"           : "GET",
                "url"            : "{{ url('usuarios.ajax') }}", // verificar a url do ajax
                "data"           : function( d ){

                }
                "dataFilter"     : function( data ){
                    var json = jQuery.parseJSON( data );
                    json.draw               = json.draw;
                    json.recordsFiltered    = json.total;
                    json.recordsTotal       = json.total;
                    json.data               = json.total;

                    return JSON.stringfy( json);
                }
            },
            "columns"       : [
                { "title" : "ID",       "data" : "id",          "name" : "id"};
                { "title" : "Nome",     "data" : "name",        "name" : "name"};
                { "title" : "Email",    "data" : "email",       "name" : "email"};
            ]
        })
    })
</script>

    {{-- 1º JQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- 2º JQuery Datatables --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    {{-- 3º Bootstrap Datatables --}}
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

@stop
