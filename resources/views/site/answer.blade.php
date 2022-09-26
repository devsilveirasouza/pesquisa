<link rel="stylesheet" href="{{ asset('bootstrap-5.0.2/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/my.css') }}">

<div class="back_4">

    <div class="container-fluid">

        <div class="row" style="padding-top: 30vh;">

            <div class="col-md-3"></div>
            <div class="col-md-4 text-light">

                <h4>O que você mais gostou ?</h4><br>

                    <input type="radio" name="ans" /> : A <small>Quiz A</small><br>
                    <input type="radio" name="ans" /> : B <small>Quiz B</small><br>
                    <input type="radio" name="ans" /> : C <small>Quiz C</small><br>
                    <input type="radio" name="ans" /> : D <small>Quiz D</small>

                    <input value="" style="visibility: hidden;" name="dbans">

            </div>
            <div class="col-md-6">
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-4">
                <a href=""><button class="btn btn-primary btn-sm float-end">Próxima</button></a>
            </div>
            <div class="col-md-5"></div>
        </div>

    </div>

</div>

<script src="{{ asset('site/jquery.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2/js/bootstrap.min.js') }}"></script>
