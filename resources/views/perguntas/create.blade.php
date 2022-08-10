@extends('adminlte::page')

{{-- CSS switch --}}
<style>
    .onoff input.toggle {
        display: none;
    }

    .onoff input.toggle+label {
        display: inline-block;
        position: relative;
        box-shadow: inset 0 0 0px 1px #d5d5d5;
        height: 30px;
        width: 100px;
        border-radius: 30px;
    }

    .onoff input.toggle+label:before {
        content: "";
        display: block;
        height: 30px;
        width: 60px;
        border-radius: 30px;
        background: rgba(19, 191, 17, 0);
        transition: 0.1s ease-in-out;
    }

    .onoff input.toggle+label:after {
        content: "";
        position: absolute;
        height: 30px;
        width: 60px;
        top: 0;
        left: 0px;
        border-radius: 30px;
        background: #fff;
        box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.2), 0 2px 4px rgba(0, 0, 0, 0.2);
        transition: 0.1s ease-in-out;
    }

    .onoff input.toggle:checked+label:before {
        width: 100%;
        background: #13bf11;
    }

    .onoff input.toggle:checked+label:after {
        left: 40px;
        box-shadow: inset 0 0 0 1px #13bf11, 0 2px 4px rgba(0, 0, 0, 0.2);
    }
</style>


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
        <form id="form_create_pergunta" action="{{ route('pergunta.cadastrar') }}" method="post">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Cadastrar pergunta</h3>
            </div>
            <div class="card-body">
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
                <div class="form-group my-3">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Resposta obrigatória?</legend>
                        <div class="my-3">
                            <!-- Checked switch -->

                            <div class="onoff">
                                <input type="checkbox" class="toggle" id="onoff1">
                                <label for="onoff1"></label>
                            </div>

                            <p id="obrigatoria">Não</p>

                        </div>
                    </div>



                    {{-- Tipo de respostas --}}
                    <div class="form-group">
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
                    </div>
                    <div class="card-footer">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success float-right mr-3" value="Cadastrar"
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <!-- Pooper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script>
        var obrigatoria = document.getElementById('obrigatoria');
        $('#onoff1').on('change', function() {
            var el = this;
            obrigatoria.innerHTML = el.checked ? 'Sim' : 'Não';

            // aqui podes juntar a lógica do ajax
            $.ajax({
                url: "some.php",
                data: {
                    obrigatoria: this.checked
                }
            }).done(function(msg) {
                if (msg == 'failed') return el.checked = !el
                .checked; // caso o servidor retorne "failed" mudar o estado do botão
                else alert("Info gravada: " + msg);
            });
        });
    </script>

@stop
