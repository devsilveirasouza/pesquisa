@extends('adminlte::page')

@section('title', 'Option List')

@section('content_header')

    <div class="card-header">
        <h1 class="text text-center">Opções de Respostas Cadastradas</h1>
    </div>

@stop

@section('content')

    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    <div class="card">
        <div class="card card-info">
            <div class="card card-header">
                <h4 class="text text-center">Listagem de Perguntas e Opções</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            {{-- <th>ID Opção</th> --}}
                            <th>Pergunta Descrição</th>
                            <th>Resposta Obrigatória</th>
                            <th>Tipo de Resposta</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perguntas as $pergunta)
                            <tr>
                                {{-- <td>{{ $pergunta->id }}</td> --}}
                                <td>{{ $pergunta->pergunta }}</td>
                                <td>{{ $pergunta->respObrigatoria }}</td>
                                <td>{{ $pergunta->tipoResposta }}</td>
                                <td>
                                    @foreach ($options as $option)
                                        {{-- @if ($perguntas[0]->respObrigatoria == 'Sim') checked="checked" @endif --}}
                                        @if ($option->id_pergunta === $pergunta->id)
                                            @foreach ($option->opcaoResposta as $opt)
                                                {{ $opt }}
                                                {{-- <input class="form-check-input ml-3 float-end" type="checkbox"
                                                            value=" {{ $opt }} " id="flexCheckDefault"> --}}
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script>
        console.log('Hi!');
    </script>
@stop

@stop
