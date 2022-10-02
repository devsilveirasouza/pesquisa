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
$heads = ['ID', 'Pergunta.', 'Resp. Obrigatória', 'Tipo Resposta', 'Id User', 'Data de Cadastro ', 'Ações'];
// Rota do processamento ajax
$url = route('perguntas.listagem');
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
    'columns' => [['data' => 'id', 'visible' => false], ['data' => 'titulo'], ['data' => 'obrigatoria'], ['data' => 'tipo'], ['data' => 'user_id', 'orderable' => false, 'visible' => false], ['data' => 'created_at', 'visible' => true], ['data' => 'buttons', 'orderable' => false, 'no-export' => true, 'width' => 5]],
];
@endphp

@section('title', 'Questions List')

@section('content_header')

    @if ($status = Session::get('mensagem'))
        <h3 class="text text-center"> {{ $status }} </h3>
    @endif

@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="text-left mt-3 mb-2 ml-3">
                            <a href="{{ route('perguntas.create') }}"
                                class="btn btn-warning float-inline btn-sm mt-2 mb-2 mr-3 add_user">Cadastrar</a>
                            Perguntas cadastradas
                            <a href="{{ route('options.index') }}" type="button"
                                class="opcao_index btn btn-success float-inline float-end btn-sm ml-1">Opções</a>
                        </h3>
                    </div>

                    <div class="card-body">
                        <x-adminlte-datatable id="pergunta" :heads="$heads" :config="$config" striped hoverable bordered
                            compressed with="buttons" />
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Datatables jquery CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('plugins.Sweetalert2', true);

@push('js')
    <script>
        // Deletar: Ajax & Sweetalert2
        $(document).on("click", ".delete_pergunta", function(e) {
            e.preventDefault();
            // alert('Ola!');
            var perguntaId = $(this).val();
            // alert(perguntaId);
            var html = "";

            html =
                '<div id="swal2-content" class="swal2-html-container" style="display: block;">{{ __('Confirmar exclusão') }}</div>';
            html = html +
                '<form action="{{ route('pergunta.delete', ' + perguntaId + ') }}" method="post">@csrf @method('delete') <br><button type="submit"';
            html = html +
                ' class="swal2-deny swal2-styled">{{ __('Sim') }}</button><button type="button" class="swal2-cancel swal2-styled"';
            html = html + ' onclick="Swal.close();">{{ __('Não') }}</button></form>';

            $(".delete_pergunta").click(() => Swal.fire({
                title: "{{ __('Excluir registro') }}",
                html: html,
                icon: 'question',
                showCancelButton: false,
                showDenyButton: false,
                showConfirmButton: false,
                denyButtonText: "{{ __('messages.yes') }}",
                cancelButtonText: "{{ __('messages.no') }}",
                iconColor: "#ff1100",
            }));
            //console.log(response);
            if (response.status == 404) {

            } else if (response.status == 200) {
                // success message
                location.href = "route('perguntas.index')";
            }
        });
    </script>
@endpush

@section('js')

    <!-- SweetAlert -->
    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('js/jquery-3.6.0.min.js') }} "></script>

    <!-- Datatables jquery min js -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

@stop
