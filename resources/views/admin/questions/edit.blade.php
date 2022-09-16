@extends('adminlte::page')

@section('title', 'Editar pergunta')
{{-- CSS --}}
@section('css')
    <!-- Switch CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.css"
        integrity="sha512-LaFU4+TlU8etxjS++v1ezEVoh69CVKqnQMiY9hw8x6MgdQP1IyZkKvK2N8/xYRiOvfZqd1s1k7MIOSV8G3lZag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('content_header')

    <div class="card-header">
        <h1 class="card-title center">Edição de Perguntas</h1>
    </div>

@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    {{-- Teste de parametros --}}
    {{-- @php
    $resposta = json_decode($perguntas[0]);
    print_r($resposta);
    @endphp --}}

    {{-- Formulário de Edição --}}
    <div class="card card-info">
        <form id="form_pergunta_edit" class="form_pergunta_edit" action="{{ route('perguntas.update', [$question->id]) }}"
            method="post">
            @csrf
            @method('put')
            <div class="card-header">
                <h3 class="card-title">Edição de perguntas</h3>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Pergunta</span>
                    </div>
                    <input type="text" class="form-control" value=" {{ $question->titulo }} " name="pergunta"
                        placeholder="Digite sua pergunta..." aria-label="Textname" aria-describedby="basic-addon1" required>
                    <!-- Input com o informações do usuário do tipo: hidden -->
                    <input type="hidden" class="form-control" name="user_id" value="{{ $user = auth()->user()->id }}"
                        aria-label="Textname" aria-describedby="basic-addon1">
                    {{-- Recuperando o Id da pergunta --}}
                    <input type="hidden" class="form-control" name="question_id" value=" {{ $question->id }} "
                        aria-label="Textname" aria-describedby="basic-addon1">
                </div>

                {{-- Button switch aqui --}}
                <div class="form-group form-switch">
                    <label class="col-form-label col-sm-6">Resposta obrigatória ?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Sim" name="obrigatoria" id="inlineRadio1"
                            @if ($question->obrigatoria == 'Sim') checked="checked" @endif />
                        <label class="form-check-label" for="inlineRadio1">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Não" name="obrigatoria" id="inlineRadio2"
                            @if ($question->obrigatoria == 'Não') checked="checked" @endif />
                        <label class="form-check-label" for="inlineRadio2">NÃO</label>
                    </div>
                </div>
                {{-- End Button switch aqui --}}

                {{-- Tipo de respostas --}}
                <div class="form-group form-switch">
                    <label for="" class="col-form-label col-sm-6">Tipo de resposta esperado: </label>
                    <div class="inline">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Texto Simples" name="tipo"
                                id="exampleRadios1" @if ($question->tipo == 'Texto Simples') checked="checked" @endif />
                            <label class="form-check-label" for="exampleRadios1">
                                Texto simples
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Escolha Única" name="tipo"
                                id="exampleRadios2" @if ($question->tipo == 'Escolha Única') checked="checked" @endif />
                            <label class="form-check-label" for="exampleRadios2">
                                Escolha única
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Escolha Múltipla" name="tipo"
                                id="exampleRadios3" @if ($question->tipo == 'Escolha Múltipla') checked="checked" @endif />
                            <label class="form-check-label" for="exampleRadios3">
                                Escolha múltipla
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Opções de respostas --}}
                <div class="form-group">
                    <label for="options">Selecione uma opção</label>
                    <select name="options[]" id="options" class="selectpicker" multiple>

                        @foreach ($options as $option)
                            <option value="{{ $option->id }}"
                                @if (old('options')) {{ in_array($option->id, old('options')) ? 'selected' : '' }}
                                @else
                                    @isset($question)
                                        {{ $question->options->contains($option->id) ? 'selected' : '' }}
                                    @endisset @endif>
                                {{ $option->titulo }}</option>
                        @endforeach

                    </select>
                </div>
                {{-- Botões --}}
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
    {{-- End Formulário de Edição --}}
@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    {{-- <script src=" {{ asset('site/question.js') }} "></script> --}}

    <!-- Pooper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="{{ asset('site/bootstrap.bundle.js') }}"></script>
    {{-- Bootstrap Multiselect Dropdown --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
        integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@stop
