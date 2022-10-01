@extends('adminlte::page')
{{-- With multiple slots, and plugin config parameter --}}
@php
$config = [
    'placeholder' => 'Select multiple options...',
    'allowClear' => true,
];
@endphp
{{-- Configuração do datatables --}}
@php
// Definindo cabeçalho do datatables
$heads = ['ID', 'Descrição da Pergunta', 'Opção respondida', 'Texto de Resposta', 'Usuário', 'Data da Resposta', 'Ações'];
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
    'columns' => [['data' => 'question_id', 'visible' => true], ['data' => 'question_titulo', 'visible' => true], ['data' => 'option_title'], ['data' => 'comment'], ['data' => 'user_name', 'orderable' => false, 'visible' => true], ['data' => 'created_at', 'visible' => true], ['data' => 'buttons', 'orderable' => false, 'no-export' => true, 'width' => 5]],
];
@endphp

@section('title', 'Respostas Cadastradas')

@section('content_header')
    <!-- Ajustando o dataTable com CSS -->
    <style type="text/css">
        table.example {
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
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">

                        <x-adminlte-select2 name="sel2Disabled" >
                            <option disabled>Selecione uma pergunta</option>
                            <option>Option 1</option>
                            <option>Option 2</option>
                        </x-adminlte-select2>

                    </div>
                </div>
                <x-adminlte-datatable id="example" :heads="$heads" :config="$config" striped hoverable bordered
                    compressed />
            </div>
        </div>
    </div>

@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="{{ asset('bootstrap-5.0.2/css/bootstrap.min.css') }}">
    <!-- Datatables jquery CSS -->
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">
    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style>
@stop

@section('js')
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/question.js') }}"></script>

    <!-- Jquery DataTable JS -->
    <script src="{{ asset('datatables/cdn.datatables.net_1.11.5.jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.fixedHeader.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap-5.0.2/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).on("click", ".btnDetails", function(e) {
            e.preventDefault();

            var resposta_id = $(this).val();
            console.log(resposta_id)
            location.href = "/resposta/show" + "/" + resposta_id;
        });
    </script>

@stop
