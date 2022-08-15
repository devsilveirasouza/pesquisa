@extends('adminlte::page')

@section('title', 'Editar pergunta')

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
        <form id="form_pergunta_edit" class="form_pergunta_edit" action="{{ route('perguntas.update', [ $perguntas[0]->id ]) }}" method="post">
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
                    <input type="text" class="form-control" value=" {{ $perguntas[0]->pergunta }} " name="pergunta"
                        placeholder="Digite sua pergunta..." aria-label="Textname" aria-describedby="basic-addon1" required>
                    <!-- Input com o informações do usuário do tipo: hidden -->
                    <input type="hidden" class="form-control" name="usuario" value="{{ $user = auth()->user()->id }}"
                        aria-label="Textname" aria-describedby="basic-addon1">
                    {{-- Recuperando o Id da pergunta --}}
                    <input type="hidden" class="form-control" name="id" value=" {{ $perguntas[0]->id }} "
                        aria-label="Textname" aria-describedby="basic-addon1">
                </div>

                {{-- Button switch aqui --}}
                <div class="form-group form-switch">
                    <label class="col-form-label col-sm-6">Resposta obrigatória ?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Sim" name="obrigatoria[]" id="inlineRadio1"
                            @if ($perguntas[0]->respObrigatoria == 'Sim') checked="checked" @endif />
                        <label class="form-check-label" for="inlineRadio1">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="Não" name="obrigatoria[]" id="inlineRadio2"
                            @if ($perguntas[0]->respObrigatoria == 'Não') checked="checked" @endif />
                        <label class="form-check-label" for="inlineRadio2">NÃO</label>
                    </div>
                </div>
                {{-- End Button switch aqui --}}

                {{-- Tipo de respostas --}}
                <div class="form-group form-switch">
                    <label for="" class="col-form-label col-sm-6">Tipo de resposta esperado: </label>
                    <div class="inline">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Texto Simples" name="tipoResposta[]" id="exampleRadios1"
                            @if ($perguntas[0]->tipoResposta == 'Texto Simples') checked="checked" @endif />
                            <label class="form-check-label" for="exampleRadios1">
                                Texto simples
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Escolha Única" name="tipoResposta[]" id="exampleRadios2"
                            @if ($perguntas[0]->tipoResposta == 'Escolha Única') checked="checked" @endif />
                            <label class="form-check-label" for="exampleRadios2">
                                Escolha única
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="Escolha Múltipla" name="tipoResposta[]" id="exampleRadios3"
                            @if ($perguntas[0]->tipoResposta == 'Escolha Múltipla') checked="checked" @endif />
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
    {{-- End Formulário de Edição --}}
@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- Script perguntas --}}
    <script src="{{ asset('site/question.js') }}"></script>

@stop
