@extends('adminlte::page')

@section('title', 'User Edit')

@section('content_header')

    <div class="card-header">
        <h1 class="card-title center">Painel Administrativo</h1>
    </div>

@stop

@section('content')
    @if ($status = Session::get('mensagem'))
    <h2> {{ $status }} </h2>
@endif

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Editar de Usuário</h3>
        </div>
        {{-- Formulário de cadastro --}}
        <form class="form-horizontal" action="{{ route('user.update', [$user -> id]) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputText3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputText3" name="name" placeholder="Name" value="{{ $user->name }}" required>
                        @if ($errors->has('name'))
                            <h6> Favor inserir seu nome! </h6>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email" value="{{ $user->email }}"
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
                <button type="submit" class="btn btn-warning btn-md ml-2 mt-2">Atualizar</button>
                <a href=" {{ route('users.listAll') }} " class="btn btn-primary btn-md col-sm-1 ml-2 mt-2"><i class="fas fa-list"></i></a>
            </div>
        </form>
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

