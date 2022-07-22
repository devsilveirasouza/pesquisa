@extends('adminlte::page')
<!-- Ajustando o dataTable com CSS -->
<style type="text/css">
    table.pergunta {
        margin-bottom: 0px !important;
        margin-top: 0px !important;
        border-collapse: collapse !important;
    }
</style>
{{-- Configuração do datatables --}}
@php
// Definindo cabeçalho do datatables
$heads = [
    'ID',
    'Pergunta.',
    'Resp. Obrigatória',
    'Tipo Resposta',
    'Id User',
    'Data de Cadastro ',
    'Ações',
];
// Rota do processamento ajax
$url = route('perguntas.listAjax');
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
        ['data' => 'id', 'visible' => true],
        ['data' => 'pergunta'],
        ['data' => 'respObrigatoria'],
        ['data' => 'tipoResposta'],
        ['data' => 'usuario'],
        ['data' => 'created_at', 'visible' => true],
        ['data' => 'buttons', 'orderable' => false, 'no-export' => true, 'width' => 5],
    ],
];
@endphp

@section('title', 'Users List')

@section('content_header')
    <h2>Listagem com Ajax</h2>
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif
@stop

@section('content')
    <x-adminlte-datatable id="pergunta" :heads="$heads" :config="$config" striped hoverable bordered compressed />

    {{-- <table id='pergTable' width='100%' border="1" style='border-collapse: collapse;'>
        <thead>
          <tr>
            <td>ID</td>
            <td>Pergunta</td>
            <td>Resposta Obrigatoria</td>
            <td>Tipo de Resposta</td>
            <td>Usuário</td>
            <td>Data de Cadastro</td>
          </tr>
        </thead>
      </table> --}}

@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Datatables jquery CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('js')
 <!-- Script -->
 {{-- <script type="text/javascript">
    $(document).ready(function(){
      // DataTable
      $('#pergTable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('perguntas.listAjax')}}",
         columns: [
            { data: 'id' },
            { data: 'pergunta' },
            { data: 'respObrigatoria' },
            { data: 'tipoResposta' },
            { data: 'usuario' },
            { data: 'created_at' },
         ]
      });
    });
    </script> --}}
    <!-- Datatables jquery 3.6.0 js -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Datatables jquery min js -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@stop
