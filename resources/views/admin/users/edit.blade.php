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
        {{-- Formulário de edição --}}
        <form class="form-horizontal form_edit_user" action="{{ route('user.update', [$user->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <ul id="updateform_errList"></ul>

                <input type="hidden" id="edit_user_id">

                <div class="form-group row">
                    <label for="inputText3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control user_name" id="inputText3" name="name"
                            placeholder="Name" value="{{ $user->name }}" required>
                        @if ($errors->has('name'))
                            <h6> Favor inserir seu nome! </h6>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control user_email" id="inputEmail3" name="email"
                            placeholder="Email" value="{{ $user->email }}" required>
                        @if ($errors->has('name'))
                            <h6> Favor inserir seu email! </h6>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control user_password" id="inputPassword3" name="password"
                            placeholder="Password" required>
                        @if ($errors->has('password'))
                            <h6> Favor inserir sua senha! </h6>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-danger btn-sm ml-2 mt-2" style="width: 80px;">Atualizar</button>
                <a href="{{ route('user.list') }}"><button type="button" class="btn btn-primary home_user btn-sm ml-2 mt-2" style="width: 80px;">Home</button></a>
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

@section('plugins.Sweetalert2', true);

@push('js')
    <script>
        $(document).ready(function() {
            $(".form_edit_user").submit(function(editar) {
                editar.preventDefault();
                Swal.fire({
                    title: "Você têm certeza?",
                    text: "Quer atualizar este registro?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim, Atualizar!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                        Swal.fire(
                            "Atualizar!",
                            "O registro foi atualizado!",
                            "success"
                        );
                    }
                });
            });
        });
    </script>
@endpush

@section('js')

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

@stop
