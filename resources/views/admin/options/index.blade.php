@extends('adminlte::page')



@section('title', 'Option List')

@section('content_header')

    <div class="card-header">
        <h3 class="text-center">Opções de Respostas Cadastradas</h3>
    </div>

@stop

@section('content')

    @if ($status = Session::get('mensagem'))
        <h2 class="text text-center"> {{ $status }} </h2>
    @endif

    <div class="card">
        <div class="card-success">
            <div class="card card-header">
                <div class="row">
                    <h3 class="text-left mt-3 mb-2 ml-3">
                        <a href="{{ route('options.create') }}"
                            class="btn btn-warning float-inline btn-sm mt-2 mb-2 ml-2 add_option">Cadastrar</a>
                        <strong>Opções Cadastradas</strong>
                        <a href="{{ route('perguntas.index') }}" type="button" value=""
                            class="perguntas_index btn btn-info float-inline float-end btn-sm mr-2">Perguntas</a>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                {{-- <th>ID Opção</th> --}}
                                <th class="col-md-10">Opções de respostas</th>
                                <th class="col-md-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($options as $option)
                                <tr>
                                    {{-- <td>{{ $option->id }}</td> --}}
                                    <td>{{ $option->titulo }}</td>
                                    <td>
                                        <form method="post" action="{{ route('options.destroy', [$option->id]) }}"
                                            class="form_delete_option">

                                            <a href="{{ route('options.edit', [$option->id]) }}" value="{{ $option->id }}"
                                                class="edit_option btn btn-warning btn-sm mr-2">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" value="{{ $option->id }}"
                                                class="delete_option btn btn-danger btn-sm mr-2">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/question.js') }}"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    {{-- Sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $('.form_delete_option').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    this.submit();
                }
            })
        });
    </script>

@stop
