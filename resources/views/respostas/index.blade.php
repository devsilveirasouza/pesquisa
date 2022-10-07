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
    'searching' => false,
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
                <div class="col-sm-3 ml-3">
                    <x-adminlte-select name="question_titulo" class="question_titulo">

                        <option id="pergunta_id" value="">Selecione uma pergunta...</option>
                        @foreach ($questions as $question)
                            <option name="question_titulo" value="{{ $question->id }}">{{ $question->titulo }}</option>
                        @endforeach

                    </x-adminlte-select>
                </div>
                {{-- Filtro do período por data --}}
                {{-- <form action="{{route('respostas.getResponse')}}" method="get"> --}}
                    <div class="col-sm-3">
                        <label for="">From Date</label>
                        <input type="date" id="from_date" value="" />
                    </div>

                    <div class="col-sm-3">
                        <label for="">To Date</label>
                        <input type="date" id="to_date" value="" />
                    </div>

                    <div class="col-sm-2">
                        <button type="submit" id="btnFilter" class="btn btn-info">Filter</button>
                    </div>
                {{-- </form> --}}
                {{-- Fim filtro período por data --}}
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
    {{-- <script src="{{ asset('site/jquery.js') }}"></script> --}}

    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap-5.0.2/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Filtro por coluna --}}
    <script>
        // $('document').ready(function() {
        $(document).on("click", "#btnFilter", function(e) {
            e.preventDefault();

            var from_date = document.getElementById('from_date').value;
            var to_date = document.getElementById('to_date').value;
            var pergunta_id = document.getElementById('pergunta_id').value;

            console.log(from_date, to_date, pergunta_id)
        });
        // });
    </script>
@stop
