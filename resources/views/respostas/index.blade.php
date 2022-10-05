@extends('adminlte::page')
{{-- Configuração do datatables --}}
@php
// Definindo cabeçalho do datatables
$heads = ['ID', 'Descrição da Pergunta', 'Resp. Obrigatória', 'Opção respondida', 'Texto de Resposta', 'Usuário', 'Data da Resposta', 'Ações'];

// Rota do processamento ajax
$url = route('respostas.getResponse');

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
    'columns' => [['data' => 'question_id', 'visible' => true], ['data' => 'question_titulo', 'visible' => true], ['data' => 'obrigatoria'], ['data' => 'option_title'], ['data' => 'comment'], ['data' => 'user_name', 'orderable' => false, 'visible' => true], ['data' => 'created_at', 'visible' => true], ['data' => 'buttons', 'orderable' => false, 'no-export' => true, 'width' => 5]],
];
@endphp

@section('title', 'Respostas Cadastradas')

@section('content_header')
    <!-- Ajustando o dataTable com CSS -->
    <style type="text/css">
        table.perguntas {
            margin-bottom: 0px !important;
            margin-top: 0px !important;
            border-collapse: collapse !important;
        }
    </style>
@stop

@section('content')

    @if ($status = Session::get('mensagem'))
        <h4> {{ $status }} </h4>
    @endif

    <div class="card">
        <div class="card-success">
            <div class="card card-header">
                <div class="row">
                    <h3 class="text-center mt-3 mb-2 ml-3">
                        Respostas Cadastradas
                    </h3>
                </div>
            </div>
            {{-- Perguntas select --}}
            <div class="row">
                <div class="col-md-4 ml-3">
                    <x-adminlte-select name="question_titulo" class="question_titulo">
                        <option value="">Selecione uma pergunta...</option>

                        @foreach ($questions as $question)
                            <option name="question_titulo" value="{{ $question->id }}">{{ $question->titulo }}</option>
                        @endforeach

                    </x-adminlte-select>
                </div>

            </div>
            <div class="card-body">
                <x-adminlte-datatable id="perguntas" class="perguntas" :heads="$heads" :config="$config" striped hoverable
                    bordered compressed />
            </div>
        </div>
    </div>

@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="{{ asset('bootstrap-5.0.2/css/bootstrap.min.css') }}">

    <!-- Datatables jquery CSS -->
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">

    {{-- Scripts Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css"> --}}

@stop

@section('js')
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/question.js') }}"></script>

    <!-- Jquery DataTable JS -->
    <script src="{{ asset('datatables/cdn.datatables.net_1.11.5.jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('datatables/dataTables.fixedHeader.min.js') }}"></script> --}}

    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap-5.0.2/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Filtro por coluna --}}
    <script>
        $('document').ready(function() {

            // Criar uma segunda linha de cabeçalho
            $('#perguntas thead tr').clone(true).appendTo('#perguntas thead');
            // Cria os campos de inputs no cabeçalho
            $('#perguntas thead tr:eq(1) th').each(function (i) {
                var title = $(this).text();
                $(this).html('<select><option value="">Selecione...</option></select>');
                $('input', this).on('keyup change', function () {
                    if (table.column().search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });

        });
    </script>

@stop
