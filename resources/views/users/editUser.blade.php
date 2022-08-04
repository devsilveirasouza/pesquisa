@extends('adminlte::page')
<!-- Ajustando o dataTable com CSS -->
<style type="text/css">
    div.content {
        margin-bottom: 0px !important;
        margin-top: 0px !important;
        border-collapse: collapse !important;
    }
</style>

@section('title', 'User Edit')

@section('content_header')

    <div class="card-header">
        <h1 class="card-title center">Atualização de Usuário</h1>
    </div>

@stop

@section('content')
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Atualizar cadastro de usuário</h3>
        </div>
        {{-- Formulário de cadastro --}}
        <form class="form-horizontal form-edit" action="{{ route('user.update', [$user->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputText3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputText3" name="name" placeholder="Name"
                            value="{{ $user->name }}" required>
                        @if ($errors->has('name'))
                            <h6> Favor inserir seu nome! </h6>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email"
                            value="{{ $user->email }}" required>
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
                <button type="submit" class="btn btn-danger btn-md ml-2 mt-2">Atualizar</button>
                <a href=" {{ route('user.list') }} " class="btn btn-primary btn-md col-sm-1 ml-2 mt-2"><i
                        class="fas fa-list"></i></a>
            </div>
        </form>
    </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/app.css"> --}}
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $('.form-edit').submit(function(editar) {
            editar.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Updated!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire(
                        'Update!',
                        'Your file has been updated.',
                        'success'
                    )
                }
            })

        });
    </script>
@stop
