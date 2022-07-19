@extends('adminlte::page')

@section('title', 'Question List')

@section('content_header')

    <div class="card-header">
        <h1 class="card-title center">Perguntas Cadastradas</h1>
    </div>

@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    <title>Perguntas</title>
    </head>

    <body>
        <h3>Listagem sem Ajax</h3>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Pergunta</td>
                        <td>Obrigatoria</td>
                        <td>Tipo Resposta</td>
                        <td>Usuário</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perguntas as $pergunta)
                        <tr>
                            <td>{{ $pergunta->id }}</td>
                            <td>{{ $pergunta->pergunta }}</td>
                            <td>{{ $pergunta->respObrigatoria }}</td>
                            <td>{{ $pergunta->tipoResposta }}</td>
                            <td>{{ $pergunta->user_id }}</td>
                            <td>
                                <a href="{{ route('pergunta.listar', [ $pergunta -> id ]) }}" class="btn btn-primary btn-sm ml-2 mt-2"><i class="fas fa-list"></i></a>
                                <a href=" " class="btn btn-warning btn-sm ml-2 mt-2"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('pergunta.delete', [ $pergunta -> id ]) }}" class="btn btn-danger btn-sm ml-2 mt-2"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
