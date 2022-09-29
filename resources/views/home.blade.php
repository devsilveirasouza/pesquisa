@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <div class="card-header">
        <a href="{{ route('pesquisa') }}"><button class="btn btn-primary btn-md">Pesquisa</button></a>
    </div>
@stop

@section('content')

    <div class="row">
        <h4 class="text text-center">Nosso objetivo é melhorar cada vez mais nosso atendimento proporcinando uma
            experiência
            única aos nossos clientes!</h4>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2/css/bootstrap.css') }}" />
@stop
