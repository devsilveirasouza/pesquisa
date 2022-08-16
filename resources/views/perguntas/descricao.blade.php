@extends('adminlte::page')

<!-- Ajustando o dataTable com CSS -->
<style type="text/css">
    table#lista_pergunta {
        margin-bottom: 0px !important;
        margin-top: 0px !important;
        border-collapse: collapse !important;
    }
</style>

@section('title', 'Pergunta descrição')

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
                    <div class="card-header">
                        <h4>Descrição da pergunta</h4>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap" id="lista_pergunta">
                            <thead>
                                <tr>
                                    {{-- <td>ID</td> --}}
                                    <td>Pergunta</td>
                                    <td>Obrigatoria</td>
                                    <td>Tipo Resposta</td>
                                    <td>Usuário de Cadastro</td>
                                    <td>Data de Cadastro</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{-- <td>{{ $pergunta->id }}</td> --}}
                                    <td>{{ $pergunta->pergunta }}</td>
                                    <td>{{ $pergunta->respObrigatoria }}</td>
                                    <td>{{ $pergunta->tipoResposta }}</td>
                                    <td>{{ $pergunta->usuario }}</td>
                                    <td>{{ date('d/m/Y', strtotime($pergunta->created_at)) }}</td>
                                    <td>
                                        <div class="button-group">
                                            <button type="button" value="Home"
                                                class="home_pergunta btn btn-info btn-sm ml-1">Home</button>
                                            <button type="button" value=" {{ $pergunta->id }} "
                                                class="edit_pergunta btn btn-warning btn-sm ml-1">Editar</button>
                                            <button type="button" value=" {{ $pergunta->id }} "
                                                class="delete_pergunta btn btn-danger btn-sm ml-1">Deletar</button>
                                        </div>
                                    </td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

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

    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('site/jquery.js') }} "></script>
    <script src=" {{ asset('site/question.js') }} "></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

@stop
