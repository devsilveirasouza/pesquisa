<link rel="stylesheet" href="{{ asset('bootstrap-5.0.2/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/my.css') }}">

<div class="back_1">

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-4" style="padding-top: 25vh;">
                <h2 class="text text-white">Vamos começar ?</h2>
            </div>
            <div class="col-md-5" style="padding-top: 60vh;">
                <a href="{{ route('home') }}"><button class="btn btn-primary btn-md text-white" style="width: 150px;">Iniciar</button></a>

                <div class="text text-center">
                    <a href="{{ route('pesquisa') }}"><button class="btn btn-light btn-md text-success mt-2" style="width: 150px;">Home</button></a>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="{{ asset('site/jquery.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2/js/bootstrap.min.js') }}"></script>
