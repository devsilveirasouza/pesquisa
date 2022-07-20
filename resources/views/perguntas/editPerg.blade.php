@extends('adminlte::page')

@section('title', 'Editar pergunta')

@section('content_header')

    <div class="card-header">
        <h1 class="card-title center">Edição de Pergunta</h1>
    </div>

@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Editar Pergunta</h3>
        </div>
        {{-- Formulário de cadastro --}}
        <form class="form-horizontal" action=" {{ route('pergunta.update', [$pergunta -> id]) }} " method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputText3" class="col-sm-2 col-form-label">Pergunta</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputText3" name="name" placeholder="Name"
                            value="{{ $pergunta->pergunta }}" required>
                        @if ($errors->has('name'))
                            <h6> Favor editar a pergunta! </h6>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputText3" class="col-sm-2 col-form-label">Resposta obrigatória</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputText3" name="name" placeholder="Name"
                            value="{{ $pergunta->respObrigatoria }}" required>
                        @if ($errors->has('name'))
                            <h6> Favor preencher este campo! </h6>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputText3" class="col-sm-2 col-form-label">Tipo de resposta</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputText3" name="name" placeholder="Name"
                            value="{{ $pergunta->tipoResposta }}" required>
                        @if ($errors->has('tipoResposta'))
                        <h6> Favor preencher este campo! </h6>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-danger btn-md ml-2 mt-2">Atualizar</button>
                <a href=" {{ route('perguntas.index') }} " class="btn btn-primary btn-md col-sm-1 ml-2 mt-2"><i class="fas fa-list"></i></a>
            </div>
        </form>
    </div>

@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
