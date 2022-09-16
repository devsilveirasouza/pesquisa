@extends('adminlte::page')

<!-- Ajustando o dataTable com CSS -->
<style type="text/css">
    table.container {
        margin-bottom: 2px !important;
        margin-top: 2px !important;
        border-collapse: collapse !important;
    }
</style>

@section('title', 'Editar Pesquisa')

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

    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form id="form_questionnaire_editar" class="form_questionnaire_editar"
                        action="{{ route('questionnaires.update', [$questionnaire->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Editar pesquisa</h4>
                        </div>
                        <div class="card-body table-responsive p-6">
                            <div class="col-md-12">
                                <div class="h-100 p-5 bg-light border rounded-3">
                                    {{-- Recuperando o Id --}}
                                    <div class="input-group mb-3">
                                        <input type="hidden" class="form-control" value="{{ $questionnaire->id }}"
                                            name="id" />
                                        <span class="input-group-text" id="basic-addon2">Título da pesquisa</span>
                                        <input type="text" class="form-control" value="{{ $questionnaire->titulo }}"
                                            name="titulo" aria-label="Recipient's option"
                                            aria-describedby="basic-addon2" />
                                    </div>
                                    {{-- Questões da pesquisa --}}
                                    <div class="form-group">
                                        <label for="questions">Selecione pelo menos uma questão</label>
                                        <select name="questions[]" id="questions" class="selectpicker" multiple>

                                            @foreach ($questions as $question)
                                            <option value="{{ $question->id }}"
                                                @if (old('questions')) {{ in_array($question->id, old('questions')) ? 'selected' : '' }}
                                                @else
                                                    @isset($questionnaire)
                                                        {{ $questionnaire->questions->contains($question->id) ? 'selected' : '' }}
                                                    @endisset @endif>
                                                {{ $question->titulo }}</option>
                                        @endforeach

                                        </select>
                                    </div>
                                    {{-- End Questões de pesquisa --}}

                                    <div class="card-footer">
                                        <div class="col-md-12">
                                            <div class="button-group">
                                                <a href="{{ route('questionnaires.index') }}"
                                                    class="btn btn-primary btn-sm ml-2 mt-2">Home</a>
                                                <button type="submit"
                                                    class="btn btn-primary float-end btn-sm mt-2 mb-2 mr-3"
                                                    value="Cadastrar">Gravar</button>
                                            </div>
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
