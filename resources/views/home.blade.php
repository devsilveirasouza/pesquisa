@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <div class="card-header">
        <a href="{{ route('pesquisa') }}"><button class="btn btn-primary btn-md">Pesquisa</button></a>
    </div>
@stop

@section('content')

    {{-- <img src=" img/pss.jpg " class="img-fluid" alt="wallpaper"> --}}
    <div class="row">
        <h4 class="text text-center">Nosso objetivo é melhorar cada vez mais nosso atendimento proporcinando uma experiência
            única aos nossos clientes!</h4>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ 'asset/css/app.css' }}" />
@stop

@section('js')
    <script>
        //Teste de scripts
        console.log('Olá Mundo!');
    </script>
@stop
