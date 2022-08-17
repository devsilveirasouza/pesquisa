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
                            <h4>Cadastro de opções de resposta</h4>
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
                                    <label for="">Usuário de Cadastro:</label>
                                    <p>{{ $pergunta->usuario }}.</p>
                                    <label for="">Data de Cadastro:</label>
                                    <p>{{ date('d/m/Y', strtotime($pergunta->created_at)) }}.</p>

                                    {{-- @if ($pergunta->respObrigatoria === 'Sim') --}}
                                    <div class="custom-control custom-input custom-control-inline">
                                        <!-- Formulário Dinâmico -->
                                        <div id="formulario">
                                            <!-- Botão para chamar a função em JS que cria os campos -->
                                            <div class="input-group mb-3">
                                                <div class="col-sm-2">
                                                    <label class="custom-control-label"
                                                        for="customTextInline1">Opção:</label>
                                                </div>
                                                <button class="btn btn-outline-primary btn-success ml-4" type="button"
                                                    id="button-addon1" onclick="adicionarCampo()"> + </button>
                                                <input type="text" class="form-control" for="option" name="option[]"
                                                    id="option" placeholder="Opção" aria-label="Option"
                                                    aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                        <!-- FIM BLOCO -->
                                        {{-- @endif --}}

                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-10">
                                            <label for="">Ações:</label><br>
                                            <div class="button-group">
                                                <a href=" {{ route('perguntas.index') }} "
                                                    class="btn btn-primary btn-sm ml-2 mt-2">Home</a>
                                                {{-- <a href=" {{ route('perguntas.edit', [$pergunta->id]) }}"
                                            class="btn btn-warning btn-sm ml-2 mt-2">Editar</i></a> --}}
                                                <button type="submit"
                                                    class="btn btn-primary float-end btn-sm mt-2 mb-2 mr-3"
                                                    value="Cadastrar" name="cadastrar">Salvar</button>
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
    <!-- Função adiciona campos -->
    <script type="text/javascript">
        var controleCampo = 1;

        function adicionarCampo() {
            controleCampo++;
            document.getElementById('formulario').insertAdjacentHTML('beforeend',
                '<div class="input-group mb-3" id="campo' +
                controleCampo +
                '"><div class="col-sm-2"><label class="custom-control-label" for="customTextInline1">Opção:</label> </div> <button type="button" class="btn btn-outline-primary btn-success ml-4" id="button-addon1 ' +
                controleCampo + '" onclick="removerCampo(' + controleCampo +
                ')"> - </button> <input type="text" class="form-control" name="option[]" id="option" placeholder="Opção" /> </div>'
            );
        }

        function removerCampo(idCampo) {
            //console.log("Campo remover: " + idCampo);
            document.getElementById('campo' + idCampo).remove();
        }
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}

    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('site/jquery.js') }} "></script>
    <script src=" {{ asset('site/question.js') }} "></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

@stop
