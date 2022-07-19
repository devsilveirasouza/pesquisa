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
                                <a href=" {{ route('users.listAll') }} " class="btn btn-primary btn-sm ml-2 mt-2"><i class="fas fa-list"></i></a>
                                <a href="{{ route('user.edit', [ $user -> id ]) }}" class="btn btn-warning btn-sm ml-2 mt-2"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('user.delete', [ $user -> id ]) }}" class="btn btn-danger btn-sm ml-2 mt-2"><i class="fas fa-trash"></i></a>
                            </td>
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
    <script>
        console.log('Hi!');
    </script>
@stop
