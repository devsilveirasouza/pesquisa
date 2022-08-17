@extends('adminlte::page')

@section('title', 'Option List')

@section('content_header')

    <div class="card-header">
        <h1 class="card-title center">Opções Cadastradas</h1>
    </div>

@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    <title>Opções</title>
    </head>

    <body>
        <h3>Listagem de Opções</h3>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>ID Opção</th>
                        <th>ID Pergunta</th>
                        <th>Opção de resposta</th>

                    </tr>
                </thead>
                <tbody>
                    <div class="card card-info">
                    @foreach ($options as $option)
                        <tr>
                            <td>{{ $option->id }}</td>
                            <td>{{ $option->id_pergunta }}</td>
                            <td>
                                @foreach ($option->opcaoResposta as $opt)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value=" {{ $opt }} "
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $opt }}
                                        </label>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </div>
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
