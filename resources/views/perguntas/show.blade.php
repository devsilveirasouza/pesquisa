@extends('adminlte::page')

<!-- Ajustando o dataTable com CSS -->
<style type="text/css">
    table#lista_pergunta {
        margin-bottom: 2px !important;
        margin-top: 2px !important;
        border-collapse: collapse !important;
    }
</style>

@section('title', 'Pergunta descrição')

@section('content_header')

    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form id="form_create_opcao_pergunta" class="form_create_opcao_pergunta"
                        action="{{ route('perguntasopcao.store') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h4>Descrição de perguntas</h4>
                        </div>
                        <div class="card-body table-responsive p-6">
                            <div class="col-md-10">
                                <div class="h-100 p-5 bg-light border rounded-3">
                                    {{-- Recuperando o Id da pergunta --}}
                                    <input type="hidden" class="form-control" name="id_pergunta"
                                        value=" {{ $pergunta->id }} " aria-label="Textname" aria-describedby="basic-addon1">
                                    <label for="">Descrição da pergunta:</label>
                                    <p>{{ $pergunta->pergunta }}</p>
                                    <label for="">Resposta obrigatória:</label>
                                    <p>{{ $pergunta->respObrigatoria }}.</p>
                                    <label for="">Tipo de Resposta:</label>
                                    <p>{{ $pergunta->tipoResposta }}.</p>
                                        <ul>Opções de resposta</ul>
                                        @foreach ($pergunta as $opcao)
                                            <li>$opcao-></li>
                                        @endforeach
                                    <label for="">Usuário de Cadastro:</label>
                                    <p>{{ $pergunta->usuario }}.</p>
                                    <label for="">Data de Cadastro:</label>
                                    <p>{{ date('d/m/Y', strtotime($pergunta->created_at)) }}.</p>

                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-10">
                                            <label for="">Ações:</label><br>
                                            <div class="button-group">
                                                <a href=" {{ route('perguntas.index') }} "
                                                    class="btn btn-primary btn-sm ml-2 mt-2">Home</a>
                                                {{-- <a href=" {{ route('perguntas.edit', [$pergunta->id]) }}"
                                            class="btn btn-warning btn-sm ml-2 mt-2">Editar</i></a> --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')
    <!-- Optional JavaScript; choose one of the two! -->
    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('site/jquery.js') }} "></script>
    <script src=" {{ asset('site/question.js') }} "></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

@stop
