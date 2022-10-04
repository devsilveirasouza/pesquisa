@extends('adminlte::page')

<!-- Ajustando o dataTable com CSS -->
<style type="text/css">
    table.container {
        margin-bottom: 2px !important;
        margin-top: 2px !important;
        border-collapse: collapse !important;
    }
</style>

@section('title', 'Opção resposta')

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

                    <form id="form_opcao_resposta" class="form_opcao_resposta" action="{{ route('options.store') }}"
                        method="post">
                        @csrf
                        <div class="card-header">
                            <h4>Cadastro de opções</h4>
                        </div>

                        <div class="card-body table-responsive p-6">
                            <div class="col-md-12">
                                <div class="h-100 p-5 bg-light border rounded-3">
                                    {{-- Recuperando o Id da pergunta --}}
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon2">Opção de resposta</span>
                                        <input type="text" class="form-control" name="titulo"
                                            placeholder="Opção de resposta..." aria-label="Recipient's option"
                                            aria-describedby="basic-addon2" required>
                                        @if ($errors->has('name'))
                                            <h6> Favor inserir seu nome! </h6>
                                        @endif
                                    </div>

                                    <div class="card-footer">
                                        <div class="col-sm-10">
                                            <div class="button-group">
                                                <a href="{{ route('options.index') }}"
                                                    class="btn btn-primary btn-sm ml-2 mt-2">Home</a>
                                                <button type="submit"
                                                    class="btn btn-primary float-end btn-sm mt-2 mb-2 mr-3"
                                                    value="Cadastrar">Salvar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

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

    <!-- Option 1: Bootstrap Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}

    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('site/jquery.js') }} "></script>
    <script src=" {{ asset('site/question.js') }} "></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

@stop
