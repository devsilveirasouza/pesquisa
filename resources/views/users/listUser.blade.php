@extends('adminlte::page')

{{-- @section('plugins.Datatables', true) --}}

{{-- @section('plugins.DatatablesPlugin', true) --}}

@section('title', 'Users List All')

@section('content_header')
    <h1>User Data</h1>
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
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Created at</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('user.delete', [$user->id]) }}" class="frm-deletar" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                            title="Delete">
                                            <i class="fa fa-lg fa-fw fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                {{-- <a href="{{ route('user.delete', [ $user->id ]) }}" class="btn btn-danger btn-sm ml-2 mt-2"><i class="fas fa-trash"></i></a> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('js/jquery-3.6.0.min.js') }} "></script>

    <script>
        $('.frm-deletar').submit(function(deletar) {
            deletar.preventDefault();

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

                    this.submit();

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        });
    </script>
@stop
