@extends('adminlte::page')

@section('title', 'Cadastrar Pergunta')
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
                {{-- Pergunta --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Pergunta</span>
                    </div>
                    <input type="text" class="form-control" name="titulo" placeholder="Digite sua pergunta..."
                        aria-label="Textname" aria-describedby="basic-addon1" required>
                    <!-- Input "user_id" do tipo: hidden -->
                    <input type="hidden" class="form-control" name="user_id" value="{{ $user = auth()->user()->id }}"
                        aria-label="Textname" aria-describedby="basic-addon1">
                </div>
                {{-- Button switch / obrigatoria --}}
                <div class="form-group form-switch">
                    <label class="col-form-label col-sm-6">Resposta obrigatória ?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="obrigatoria" id="inlineRadio1" value="Sim">
                        <label class="form-check-label" for="inlineRadio1">SIM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="obrigatoria" id="inlineRadio2" value="Não"
                            checked>
                        <label class="form-check-label" for="inlineRadio2">NÃO</label>
                    </div>
                </div>
                {{-- End Button switch aqui --}}
                {{-- Switch button / Tipo resposta --}}
                <div class="form-group form-switch">
                    <label for="" class="col-form-label col-sm-6">Tipo de resposta esperado: </label>
                    <div class="inline">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="exampleRadios1"
                                value="Texto Simples">
                            <label class="form-check-label" for="exampleRadios1">
                                Texto simples
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="exampleRadios2"
                                value="Escolha Única" checked>
                            <label class="form-check-label" for="exampleRadios2">
                                Escolha única
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo" id="exampleRadios3"
                                value="Escolha Múltipla">
                            <label class="form-check-label" for="exampleRadios3">
                                Escolha múltipla
                            </label>
                        </div>
                    </div>
                </div>
                {{-- Opções de respostas --}}
                <div class="form-group">
                    <label for="option">Selecione uma opção</label>
                    <select name="options[]" id="options" class="selectpicker" multiple>
                        @if ($options)

                            @foreach ($options as $option)
                                <option value="{{ $option->id }}">{{ $option->titulo }}</option>
                            @endforeach

                        @else
                            <p>Não existem opções disponíveis</p>
                        @endif

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
