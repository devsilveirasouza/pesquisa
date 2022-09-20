@extends('adminlte::page')

@section('title', 'Pesquisa')
{{-- CSS --}}
@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('content_header')
    <div class="card-header">
        <h3 class="text text-center">Pesquisa de Satisfação de Clientes</h3>
    </div>
@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    {{-- Campos de entradas --}}
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><strong>Responder Pesquisa</strong></h3>
        </div>
    </div>
    <div class="card-body bg-marine">
        {{-- Formulário de resposta da pesquisa --}}
        <form id="form_pesquisa" class="form_pesquisa" action="{{ route('pesquisas.store') }}" method="post">
            @csrf

            {{-- Título do questionário --}}
            <div class="input-group mb-3">
                <h3 class="text-red">{{ $questionnaire->titulo }}</h3>
            </div>

            <label for="questions">Questões</label>
            @php
                $q = 0;
                $o = 0;
            @endphp

            {{-- Exibir questões da pesquisa --}}
            @foreach ($questionnaire->questions as $question)
                @php
                    $q = $q + 1;
                @endphp
                <div class="questions_{{ $q }}">
                    {{-- Exibe as questões da pesquisa --}}
                    <div class="question_{{ $q }}">
                        <input type="text" name="questions[]" value="{{ $question->id }}" />
                        <label value="{{ $question->titulo }}"
                            name="questions[]"><strong>{{ $question->titulo }}</strong></label>

                        @if ($question->tipo === 'Escolha Única')
                            {{-- Exibe as opções de respotas disponíveis da questão --}}
                            @foreach ($question->options as $option)
                                @php
                                    $o = $o + 1;
                                @endphp
                                {{-- Bloco Radio buttons --}}
                                <div class="form-check">
                                    <input type="radio" name="options[{{ $question->id }}]" value="{{ $option->id }}" />
                                    <label class="form-check-label" for="{{ $question->id . $o }}">
                                        {{ $option->titulo }}
                                    </label>
                                </div>
                            @endforeach
                        @elseif ($question->tipo === 'Escolha Múltipla')
                            {{-- Bloco Checkbox --}}
                            @foreach ($question->options as $option)
                                @php
                                    $o = $o + 1;
                                @endphp
                                {{-- Bloco Radio buttons --}}
                                <div class="form-check">
                                    <input type="checkbox" name="options[{{ $question->id }}][]"
                                        value="{{ $option->id }}" />
                                    <label class="form-check-label" for="{{ $question->id . $o }}">
                                        {{ $option->titulo }}
                                    </label>
                                </div>
                            @endforeach
                            {{-- Bloco Area de texto --}}
                            @else
                            <div class="form-floating">
                                <textarea class="form-control" name="options[]" style="height: 100px"></textarea>
                                <label for="{{ $question->id . $o }}"></label>
                              </div>
                        @endif

                    </div>
                </div>
            @endforeach

            {{-- Botões --}}
            <div class="card-footer">
                <div class="col-sm-10">
                    <a href="{{ route('pesquisas.index') }}" class="btn btn-success btn-md mt-2 mb-2 mr-3 ">Voltar</a>
                    <button type="submit" class="btn btn-primary btn-md mt-2 mb-2 mr-3" value="Cadastrar"
                        name="cadastrar">Gravar
                    </button>
                </div>
            </div>
        </form>
    </div>

@stop


@section('js')
    <!-- Optional JavaScript -->
    <!-- SweetAlert -->
    <script src=" {{ asset('js/app.js') }} "></script>

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
