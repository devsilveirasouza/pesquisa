<link rel="stylesheet" href="{{ asset('bootstrap-5.0.2/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/my.css') }}">

<div class="back_4">

    <div class="container-fluid">

        <form method="POST" action="/submitans">
            @csrf
            <div class="row" style="padding-top: 30vh;">

                <div class="col-md-3"></div>

                <div class="col-md-4 text-light">
                    <!-- Input "user_id" do tipo: hidden - Verifica que existe usuário logado e recupera o id -->
                    <input type="text" class="form-control" name="user_id" value="@if( isset( auth()->user()->id ) ) {{ $user = auth()->user()->id }} @endif"
                        aria-label="Textname" aria-describedby="basic-addon1">

                    {{-- Exibe a pergunta --}}
                    <h4> # {{ Session::get('nextq') }} : {{ $question->titulo }}</h4>
                    {{-- Recupera o id da pergunta e envia pelo formulário --}}
                    <input type="hidden" value="{{ $question->id }}" name="question_id">
                    <br>
                    {{-- Lista as opções diponíveis --}}
                    @if ($question->tipo === 'Escolha Única')
                        {{-- Exibe as opções de respotas disponíveis da questão --}}
                        @foreach ($question->options as $option)
                            {{-- Bloco Radio buttons --}}
                            <div class="form-check">
                                <input type="radio" name="option_id" value="{{ $option->id }}" />
                                <label class="form-check-label">
                                    {{ $option->titulo }}
                                </label>
                            </div>

                        @endforeach
                    @elseif ($question->tipo === 'Escolha Múltipla')
                        {{-- Bloco Checkbox --}}
                        @foreach ($question->options as $option)

                            <div class="form-check">
                                <input type="checkbox" name="option_id[]" value="{{ $option->id }}" />
                                <label class="form-check-label">
                                    {{ $option->titulo }}
                                </label>
                            </div>

                        @endforeach
                        {{-- Bloco Area de texto --}}
                    @else
                        <div class="form-floating">
                            <textarea class="form-control" name="comment" style="height: 100px"></textarea>
                        </div>
                    @endif
                    {{-- End Lista opções disponíveis --}}
                </div>
                <div class="col-md-6">
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-sm float-end">Próxima</button>
                </div>
                <div class="col-md-5"></div>
            </div>

        </form>

    </div>

</div>

<script src="{{ asset('site/jquery.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2/js/bootstrap.min.js') }}"></script>
