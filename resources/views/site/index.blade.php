<link rel="stylesheet" href="{{ asset('bootstrap-5.0.2/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/my.css') }}">

<div class="back_2">

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-5"></div>

            <div class="col-md-5" style="padding-top: 70vh;">
                <a href="{{ route('home') }}" ><button style="width: 120px;"
                        class="btn btn-primary btn-md text-white">Admin</button></a>
                <a href="/start" ><button style="width: 120px;"
                        class="btn btn-primary btn-md text-white">Pesquisa</button></a>
            </div>
        </div>

    </div>

</div>

<script src="{{ asset('site/jquery.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2/js/bootstrap.min.js') }}"></script>
