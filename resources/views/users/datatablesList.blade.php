@extends('adminlte::page')
{{-- Setup data for datatables --}}
@php
// Definindo cabeçalho - Título das colunas - ok 01/05/2022 //
$heads = [
    'ID',
    'Nome.',
    'Email',
];
// Rota de busca das informações - ok 01/05/2022 //
$url = route('users.ajaxList');
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
        ['data' =>    'id',      'dt' => 'id'],
        ['data' =>    'name',    'dt' => 'nome'],
        ['data' =>    'email',   'dt' => 'email'],
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
    <!-- Bloco da tabela listagem de usuários - ok 01/05/2022 -->
    <x-adminlte-datatable class="consulta_table" id="consulta_table" :heads="$heads" head-theme="dark" :config="$config" striped hoverable bordered
        compressed />
    <!-- Bloco tabela listagem usuários Fim -->

@stop

@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>

@stop

@section('js')

@section('scripts')

<script>
    $( function () {
        $('.consulta_table').Datatable({
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
                "url"            : "{{ url('datatables/users') }}", // verificar a url do ajax
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

    {{-- Ajax --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script> --}}
    {{-- 1º JQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- 2º JQuery Datatables --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    {{-- 3º Bootstrap Datatables --}}
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

@stop
