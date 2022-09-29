@extends('adminlte::page')

@section('title', 'Respostas das Pesquisas')

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

                    <div class="card-header">
                        <h4>Descrição resposta</h4>
                    </div>
                    <div class="card-body table-responsive p-6">
                        <div class="col-md-10">
                            <div class="h-100 p-5 bg-light border rounded-3">
                                {{-- Recuperando o Id da pergunta --}}
                                <input type="hidden" class="form-control" name="question_id"
                                    value=" {{ $answers[0]->question_id }} " aria-label="Textname"
                                    aria-describedby="basic-addon1">

                                @if ($answers)
                                    <p>{{ $answers[0]->question_titulo }}</p>
                                @else
                                    <p>Não existe pergunta respondida.</p>
                                @endif
                                {{-- Respostas cadastradas de seleção --}}
                                <div class="row">
                                    <ul><strong>Respostas de seleção</strong></ul>
                                    @php
                                        $id_opt = 0;
                                        $c_opt = count($answers);
                                    @endphp

                                    @while ($id_opt < $c_opt)
                                        <li>{{ $answers[$id_opt]->option_id }}</li>
                                        @php
                                            $id_opt++;
                                        @endphp
                                    @endwhile
                                </div>
                                {{-- Respostas de comentário --}}
                                <div class="row">
                                    <ul><strong>Resposta de Comentário</strong></ul>
                                    @php
                                        $id_com = 0;
                                        $c_com = count($answers);
                                    @endphp
                                    @if ($answers[$id_com]->comment)
                                        @while ($id_com < $c_com)
                                            <p>{{ $answers[$id_com]->comment }}</p>
                                            @php
                                                $id_com++;
                                            @endphp
                                        @endwhile
                                    @else
                                        <p>Não existe comentário para esta questão.</p>
                                    @endif

                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="col-sm-10">
                                    <label for="">Ações:</label><br>
                                    <div class="button-group">
                                        <a href="{{ route('respostas.index') }}" class="btn btn-primary btn-sm ml-2 mt-2">Home</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

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
    <!-- Optional JavaScript; choose one of the two! -->
    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('site/jquery.js') }} "></script>
    <script src=" {{ asset('site/question.js') }} "></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

@stop
