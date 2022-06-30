@extends('adminlte::page')
{{-- Setup data for datatables --}}
@php
    // Definindo cabeçalho - Título das colunas
    $heads = [
        'ID',
        'Nome.',
        'Email',
        'Ações', // 'Tipo','Situação','Aut.', <= removed
    ];
    // Rota de busca das informações
    $url = route('users.listAll');
    // configuração geral
    $config = [
        'language' => [
            'url' => 'datatables_translates/pt-BR.json', // Tradução
        ],
        'processing' => true,
        'serverSide' => true,
        'searching' => true,
        'ordering' => false,
        'ajax' => $url,
        'sDom' => 'lrtip', // Remover busca geral
        'columns' => [
            ['data' => 'id', 'className' => 'id'],
            ['data' => 'buttons', 'orderable' => false, 'no-export' => true, 'width' => 5],
            ['data' => 'id_mdlog', 'className' => 'id_mdlog', 'visible' => false],
            ['data' => 'id_senior', 'className' => 'id_senior', 'visible' => false],
            ['data' => 'nome_fantasia', 'className' => 'nome_fantasia', 'visible' => false],
            ['data' => 'razao_social', 'className' => 'razao_social', 'visible' => false],
            ['data' => 'documento', 'className' => 'documento', 'visible' => false],
            ['data' => 'favorecido', 'className' => 'favorecido', 'visible' => false],
            ['data' => 'pendency_statuses_id', 'className' => 'pendency_statuses_id', 'visible' => false],
            ['data' => 'deleted_at', 'className' => 'deleted_at', 'visible' => false],
            ['data' => 'macro_mdlog', 'className' => 'macro_mdlog', 'visible' => false],
            ['data' => 'fornecedor_senior', 'className' => 'fornecedor_senior', 'visible' => false],
        ],
    ];
@endphp

@section('title', 'Users List')

@section('content_header')
    <h1>Listagem de Usuários</h1>
    @if ($status = Session::get('mensagem'))
        <h2> {{ $status }} </h2>
    @endif
@stop

@section('content')

    <x-adminlte-datatable id="consulta" :heads="$heads" :config="$config" striped hoverable bordered compressed />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable with register users</h3>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">ID User</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Name User</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">Email User(s)</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">Created User(s)</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">Opções</th>
                                    {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending">CSS grade</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $user->id }}</td>
                                        <td> {{ $user->name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                                        <td>
                                            <a href=" {{ route('user.listUser', ['user' => $user -> id]) }} " class="btn btn-primary btn-sm ml-2 mt-2"><i class="fas fa-list"></i></a>
                                            <a href="{{ route('user.edit', [ $user -> id ]) }}" class="btn btn-warning btn-sm ml-2 mt-2"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('user.delete', [ $user -> id ]) }}" class="btn btn-danger btn-sm ml-2 mt-2"><i class="fas fa-trash"></i></a>
                                        </td>
                                        </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <hr>
                            {{ $users->links() }}

                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of
                            57 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#"
                                        aria-controls="example1" data-dt-idx="0" tabindex="0"
                                        class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="example1"
                                        data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2"
                                        tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3"
                                        tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4"
                                        tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5"
                                        tabindex="0" class="page-link">5</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6"
                                        tabindex="0" class="page-link">6</a></li>
                                <li class="paginate_button page-item next" id="example1_next"><a href="#"
                                        aria-controls="example1" data-dt-idx="7" tabindex="0"
                                        class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
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
