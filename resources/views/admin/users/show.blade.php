@extends('adminlte::page')

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
                                <a href="{{ route('user.edit', [$user->id]) }}"><button value="{{ $user->id }}"
                                        class="edit_user btn btn-xs btn-default text-primary mx-1 shadow"
                                        style="width: 42px; height: 42px;"><i class="fa fa-lg fa-fw fa-pen"></i></button></a>
                                <button value="{{ $user->id }}"
                                    class="delete_user btn btn-xs btn-default text-danger mx-1 shadow"
                                    style="width: 42px; height: 42px;"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                                <a href="{{ route('user.list') }}"><button
                                        class="btn btn-primary home_user btn-sm ml-2 mt-2"
                                        style="width: 42px; height: 42px;"><i
                                            class="fa fa-lg fa-fw fa-home"></i></button></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datatables jquery CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('plugins.Sweetalert2', true);

@push('js')
    <script>
        $(document).on("click", ".delete_user", function(e) {
            e.preventDefault();
            const user_id = $(this).val();
            Swal.fire({
                title: "Você quer excluir?",
                text: "Não será mais possível usar este registro!",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, Excluir!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    //console.log(user_id);
                    $.ajax({
                        type: "DELETE",
                        url: "/usuarios-delete/" + user_id,
                    });
                    Swal.fire(
                        "Excluído!",
                        "O registro foi excluído com sucesso!",
                        "success"
                    );
                    location.href = "{{ route('user.list') }}";
                }
            });
        });
    </script>
@endpush

@section('js')
    <!-- SweetAlert -->
    <script src=" {{ asset('js/app.js') }} "></script>
    <script src=" {{ asset('js/jquery-3.6.0.min.js') }} "></script>
    <!-- Datatables jquery min js -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@stop
