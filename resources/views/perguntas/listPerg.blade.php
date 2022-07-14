@extends('adminlte::page')

{{-- @section('plugins.Datatables', true) --}}

{{-- @section('plugins.DatatablesPlugin', true) --}}

@section('title', 'Pergunta descrição')

@section('content_header')
    <h1>Descrição da pergunta</h1>
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Pergunta</td>
                            <td>Obrigatoria</td>
                            <td>Tipo Resposta</td>
                            <td>Usuário</td>
                            <td>Data Cadastro</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pergunta->id }}</td>
                            <td>{{ $pergunta->pergunta }}</td>
                            <td>{{ $pergunta->respObrigatoria }}</td>
                            <td>{{ $pergunta->tipoResposta }}</td>
                            <td>{{ $pergunta->usuario }}</td>
                            <td>{{ date('d/m/Y', strtotime($pergunta->created_at)) }}</td>
                            <td>
                                <a href="  " class="btn btn-primary btn-sm ml-2 mt-2"><i class="fas fa-list"></i></a>
                                <a href="  " class="btn btn-warning btn-sm ml-2 mt-2"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm ml-2 mt-2"><i class="fas fa-trash"></i></a>
                            </td>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
