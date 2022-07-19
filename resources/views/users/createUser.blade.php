@extends('adminlte::page')

@section('title', 'User Register')

@section('content_header')

    <div class="card-header">
        <h1 class="card-title center">Cadastro de Usuário</h1>
    </div>

@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif


    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Painel de cadastro</h3>
        </div>
        {{-- Formulário de cadastro --}}
        <form class="form-horizontal" action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputText3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputText3" name="name" placeholder="Name" required>
                        @if ($errors->has('name'))
                            <h6> Favor inserir seu nome! </h6>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email"
                            required>
                        @if ($errors->has('name'))
                            <h6> Favor inserir seu email! </h6>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" name="password"
                            placeholder="Password" required>
                        @if ($errors->has('password'))
                            <h6> Favor inserir sua senha! </h6>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-info">Save</button>
                <button type="reset" class="btn btn-danger float-right">Limpar</button>
            </div>
        </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script>
        console.log('{{ $user = $user->id; }}');
    </script>
@stop
