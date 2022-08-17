@extends('adminlte::page')

@section('title', 'Question Option')

@section('content_header')

    <div class="card-header">
        <h1 class="card-title">Opção de resposta</h1>
    </div>

@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Cadastrar Opções de Resposta</h3>
        </div>
        <section>
            {{-- Formulário de cadastro --}}
            <form id="form1" class="form-horizontal" action="" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group row ml-2">
                        <label for="inputText3" class="col-sm-2 col-form-label">Pergunta:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputText3" name="question"
                                placeholder="Preencha aqui!" required>
                            @if ($errors->has('question'))
                                <h6> Favor digitar uma Pergunta! </h6>
                            @endif
                        </div>
                    </div>
                    {{-- Campos dinâmicos dinâmico --}}
                    <div class="col-sm-10">
                        <div class="form-group">
                            <label for="option">Option:</label>
                            <input type="text" class="form-control" id="option" name="option"
                                placeholder="Preencha a opção..." autocomplete="off">
                        </div>
                    </div>
                    <!-- Campos dinamicos -->
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="box" id="box"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="add" class="add btn btn-success">Nova Opção</button>
                        <button type="submit" id="buy" class="buy btn btn-info float-right">Finalizar</button>
                    </div>
        </section>
    </div>
    </form>

    {{-- Function Javascript --}}
    <script>
        var btn_add = document.getElementById('add');
        var btn_buy = document.getElementById('buy');
        var form1 = document.getElementById('form1');
        var box = document.getElementById('box');

        var contador = 1;

        btn_add.addEventListener('click', function() {
            contador++;
            createLabel();
            createInput();
        });

        //<label for="nome">Option: </label>
        function createLabel() {
            var elemento = document.createElement('label');
            elemento.setAttribute('for', 'option_' + contador);
            elemento.textContent = 'Option:';

            box.appendChild(elemento);
        }

        //<input type="text" name="option" id="option" autocomplete="off"/>
        function createInput() {
            var elemento = document.createElement('input');
            elemento.setAttribute('type', 'text');
            elemento.setAttribute('name', 'option_' + contador);
            elemento.setAttribute('id', 'option_' + contador);
            elemento.setAttribute('autocomplete', 'off');

            box.appendChild(elemento);
        }

        btn_buy.addEventListener('click', function() {
            form1.submit();
        });

        form1.addEventListener('submit', function() {
            alert(serialize(document.forms[0]));
        });

        function serialize(form) {
            if (!form || form.nodeName !== "FORM") {
                return
            }
            var i, j, q = [];
            for (i = form.elements.length - 1; i >= 0; i = i - 1) {
                if (form.elements[i].name === "") {
                    continue
                }
                switch (form.elements[i].nodeName) {
                    case "INPUT":
                        switch (form.elements[i].type) {
                            case "text":
                            case "hidden":
                            case "password":
                            case "button":
                            case "reset":
                            case "submit":
                                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                                break;
                            case "checkbox":
                            case "radio":
                                if (form.elements[i].checked) {
                                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value))
                                }
                                break;
                            case "file":
                                break
                        }
                        break;
                    case "TEXTAREA":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break;
                    case "SELECT":
                        switch (form.elements[i].type) {
                            case "select-one":
                                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                                break;
                            case "select-multiple":
                                for (j = form.elements[i].options.length - 1; j >= 0; j = j - 1) {
                                    if (form.elements[i].options[j].selected) {
                                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].options[j]
                                            .value))
                                    }
                                }
                                break
                        }
                        break;
                    case "BUTTON":
                        switch (form.elements[i].type) {
                            case "reset":
                            case "submit":
                            case "button":
                                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                                break
                        }
                        break
                }
            }
            return q.join("&")
        };
    </script>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')

@stop
