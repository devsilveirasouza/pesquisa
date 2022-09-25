@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
@stop

@section('title', 'Pesquisas Cadastradas')

@section('content_header')

    <div class="card-header">
        <h4 class="text-left">Listagem de Questionários</h4>
    </div>

@stop

@section('content')

    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    <div class="card">
        <div class="card-success">
            <div class="card card-header">
                <div class="row">
                    <h3 class="text-center mt-3 mb-2 ml-3">
                        Questionário
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questionnaires as $questionnaire)
                                <tr>
                                    <td>{{ $questionnaire->id }}</td>
                                    <td>{{ $questionnaire->titulo }}</td>
                                    <td>
                                        <div class="float-end">
                                            <a href="{{ route('pesquisas.create', $questionnaire->id) }}" value="#"
                                                class="view_questionnaire btn btn-success btn-sm ml-1">Iniciar
                                                pesquisa</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/question.js') }}"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    {{-- Sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@stop
