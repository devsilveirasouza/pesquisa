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
                            <td>Usuário de Cadastro</td>
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
                <div class="col-md-12">
                    <div class="h-100 p-5 bg-light border rounded-3">
                        <label for="">Descrição da pergunta:</label>
                        <p>{{ $pergunta->pergunta }}</p>
                        <label for="">Resposta obrigatória:</label>
                        <p>{{ $pergunta->respObrigatoria }}.</p>
                        <label for="">Tipo de Resposta:</label>
                        <p>{{ $pergunta->tipoResposta }}.</p>
                        <label for="">Usuário de Cadastro:</label>
                        <p>{{ $pergunta->usuario }}.</p>
                        <label for="">Data de Cadastro:</label>
                        <p>{{ date('d/m/Y', strtotime($pergunta->created_at)) }}.</p>
                        <label for="">Ações:</label><br>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-success mr-1"><i class="fas fa-list"></i></button>
                            <button type="button" class="btn btn-warning mr-1"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger mr-1"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
