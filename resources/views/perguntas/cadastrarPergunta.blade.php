@extends('adminlte::page')

@section('title', 'Cadastrar Pergunta')

@section('content_header')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <div class="card-header">
        <h1 class="card-title center">Painel Administrativo</h1>
    </div>
@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    <h3>Tela de Cadastrar as perguntas</h3>

    {{-- Campos de entradas --}}
    <div class="card card-info">
        <form action="{{ route('pergunta.cadastrar') }}" method="post">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Cadastrar pergunta</h3>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Pergunta</span>
                </div>
                <input type="text" class="form-control" name="pergunta" placeholder="Digite sua pergunta..."
                    aria-label="Textname" aria-describedby="basic-addon1">
                <!-- Input com o informações do usuário do tipo: hidden -->
                <input type="hidden" class="form-control" name="usuario" value="{{ $user = auth()->user()->id }}"
                    aria-label="Textname" aria-describedby="basic-addon1">
            </div>

            {{-- Radio button aqui --}}
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Resposta obrigatória?</legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="respObrigatoria" id="inlineRadio1"
                            value="Sim">
                        <label class="form-check-label" for="inlineRadio1">SIM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="respObrigatoria" id="inlineRadio2"
                            value="Não">
                        <label class="form-check-label" for="inlineRadio2">NÃO</label>
                    </div>
                </div>
            </fieldset>
            {{-- Tipo de respostas --}}
            <fieldset class="form-group">
                <div class="inline">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipoResposta" id="exampleRadios1"
                            value="Texto Simples">
                        <label class="form-check-label" for="exampleRadios1">
                            Texto simples
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipoResposta" id="exampleRadios2"
                            value="Escolha Única">
                        <label class="form-check-label" for="exampleRadios2">
                            Escolha única
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipoResposta" id="exampleRadios3"
                            value="Escolha Múltipla">
                        <label class="form-check-label" for="exampleRadios3">
                            Escolha múltipla
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="card-footer">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success float-right mr-3" value="Cadastrar"
                        name="cadastrar">Salvar</button>
                </div>
            </div>
        </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script>
        console.log('Hi!');
    </script>
@stop
