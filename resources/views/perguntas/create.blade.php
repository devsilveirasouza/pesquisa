@extends('adminlte::page')

@section('title', 'Cadastrar Pergunta')

@section('content_header')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <div class="card-header">
        <h1 class="card-title center">Perguntas</h1>
    </div>
@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    {{-- Campos de entradas --}}
    <div class="card card-info">
        <form id="form_create_pergunta" class="form_create_pergunta" action="{{ route('perguntas.store') }}" method="post">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Cadastro de pergunta</h3>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Pergunta</span>
                    </div>
                    <input type="text" class="form-control" name="pergunta" placeholder="Digite sua pergunta..."
                        aria-label="Textname" aria-describedby="basic-addon1" required>
                    <!-- Input com o informações do usuário do tipo: hidden -->
                    <input type="hidden" class="form-control" name="usuario" value="{{ $user = auth()->user()->id }}"
                        aria-label="Textname" aria-describedby="basic-addon1">
                </div>

                {{-- Button switch aqui --}}
                <div class="form-group form-switch">
                    <label class="col-form-label col-sm-6">Resposta obrigatória ?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="obrigatoria[]" id="inlineRadio1"
                            value="Sim">
                        <label class="form-check-label" for="inlineRadio1">SIM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="obrigatoria[]" id="inlineRadio2"
                        value="Não" checked>
                        <label class="form-check-label" for="inlineRadio2">NÃO</label>
                    </div>
                </div>
                {{-- End Button switch aqui --}}

                {{-- Tipo de respostas --}}
                <div class="form-group form-switch">
                    <label for="" class="col-form-label col-sm-6">Tipo de resposta esperado: </label>
                    <div class="inline">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoResposta[]" id="exampleRadios1"
                                value="Texto Simples">
                            <label class="form-check-label" for="exampleRadios1">
                                Texto simples
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoResposta[]" id="exampleRadios2"
                                value="Escolha Única" checked>
                            <label class="form-check-label" for="exampleRadios2">
                                Escolha única
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoResposta[]" id="exampleRadios3"
                                value="Escolha Múltipla">
                            <label class="form-check-label" for="exampleRadios3">
                                Escolha múltipla
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-sm-10">
                        <a href="{{ route('perguntas.index') }}"
                            class="btn btn-success float-end btn-sm mt-2 mb-2 mr-3 ">Home</a>
                        <button type="submit" class="btn btn-primary float-end btn-sm mt-2 mb-2 mr-3" value="Cadastrar"
                            name="cadastrar">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@stop

@section('css')
    <!-- Switch CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.css"
        integrity="sha512-LaFU4+TlU8etxjS++v1ezEVoh69CVKqnQMiY9hw8x6MgdQP1IyZkKvK2N8/xYRiOvfZqd1s1k7MIOSV8G3lZag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('js')
    <!-- Optional JavaScript -->
    <!-- Switch JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.js"
        integrity="sha512-SLEOKOI7a9IRAexnyg74nYgEIhjcuZ7XfY8SUycaSjwsGJCQgw33PRtThxOdqvz4BaQrHkxkbb+h+j4kEBZB1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- SweetAlert -->
    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('js/jquery-3.6.0.min.js') }} "></script>
    {{-- Scripts Users --}}
    <script src=" {{ asset('site/question.js') }} "></script>

    <!-- Pooper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

@stop
