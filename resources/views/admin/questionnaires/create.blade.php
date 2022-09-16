@extends('adminlte::page')

@section('title', 'Questionário')
{{-- CSS --}}
@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
          integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
        <form id="form_questionnaire" class="form_questionnaire" action="{{ route('questionnaires.store') }}"
              method="post">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Cadastrar Pesquisa</h3>
            </div>
            <div class="card-body">
                {{-- Título do questionário --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Título</span>
                    </div>
                    <input type="text" class="form-control" id="titulo" name="titulo"
                           placeholder="Digite um título..."
                           aria-label="Textname" aria-describedby="basic-addon1" required>
                    <!-- Input "user_id" do tipo: hidden -->
                    {{--<input type="hidden" class="form-control" name="user_id" value="{{ $user = auth()->user()->id }}"
                               aria-label="Textname" aria-describedby="basic-addon1">--}}
                </div>
                {{-- Seleciona questões para cadastrar pesquisa --}}
                <div class="form-group">
                    <label for="questions">Selecione uma ou mais questões</label>
                    <select name="questions[]" id="questions" class="selectpicker" multiple>

                        @forelse ($questions as $question)
                            <option value="{{ $question->id }}">{{ $question->titulo }}</option>
                        @empty
                            <option><span>Não existem questões disponíveis</span></option>
                        @endforelse

                    </select>
                </div>
                {{-- Botões --}}
                <div class="card-footer">
                    <div class="col-sm-10">
                        <a href="{{ route('questionnaires.index') }}"
                           class="btn btn-success float-end btn-sm mt-2 mb-2 mr-3 ">Home</a>
                        <button type="submit" class="btn btn-primary float-end btn-sm mt-2 mb-2 mr-3" value="Cadastrar"
                                name="cadastrar">Gravar
                        </button>
                    </div>
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

