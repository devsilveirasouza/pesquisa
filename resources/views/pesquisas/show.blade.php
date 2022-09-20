@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
@stop

@section('title', 'Formulário Pesquisa')

@section('content_header')

    <div class="card-header">
        <h3 class="text-center">Satisfação de Cliente</h3>
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
                    <h3 class="text-left mt-3 mb-2 ml-3">Responder pesquisa</h3>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título da Pesquisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $questionnaire->id }}</td>
                                <td>{{ $questionnaire->titulo }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @forelse ($questionnaire->questions as $questions)
                        <div class="table-responsive col-md-12">
                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th><strong>Pergunta:</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div class="row">
                                        <tr>
                                            <td>{{ $questions->titulo }}</td>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th><strong>Opções de resposta:</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <div class="row">
                                                        @forelse ($questions->options as $options)
                                                            <tr>
                                                                <td>{{ $options->titulo }}</td>
                                                            @empty
                                                                <td>Não existem opções cadastradas.</td>
                                                            </tr>
                                                        @endforelse
                                                    </div>
                                                </tbody>
                                            </table>
                                        @empty
                                            <td>Não existem questões cadastradas.</td>
                                        </tr>
                                    </div>
                                </tbody>

                            </table>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card-footer">
                <div class="col-sm-10">

                    <div class="button-group">
                        <a href=" {{ route('pesquisas.index') }} " class="btn btn-success btn-sm ml-2 mt-2">Home</a>
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
