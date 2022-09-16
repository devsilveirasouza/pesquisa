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
                                    <button type="button" value="{{ $user->id }}"
                                        class="edit_user btn btn-warning btn-sm ml-1">Edit</button>
                                    <button type="button" value="{{ $user->id }}"
                                        class="delete_user btn btn-danger btn-sm ml-1">Delete</button>
                                    <button type="button" class="home_user btn btn-info btn-sm ml-1">Home</button>
                                </div>
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
    {{-- Script Users --}}
    <script src=" {{ asset('site/user.js') }} "></script>

@stop
