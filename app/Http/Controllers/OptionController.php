<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\Option;

class OptionController extends Controller
{
    public function index()
    {
        return "Indefinida ainda!";
    }

    public function create(Question $pergunta)
    {
        /**
         * -- Consulta o id de usuario informado na pergunta e
         * busca o usuario e retorna o name  Users
         **/
        $usuario = User::find($pergunta->user_id);
        // dd($usuario);

        $pergunta->usuario = $usuario->name;

        return view('perguntas.opcaoCreate', ['pergunta' => $pergunta]);
    }

    public function store(Request $request)
    {
        //$opcao = $request->all();
        $opcao = new Option;

        $opcao->id_pergunta = $request->id_pergunta;
        $opcao->opcaoResposta = $request->option;
        // $opcao->opcaoResposta = implode(',', ($request->option));

        // dd($opcao);
        $opcao->save();

        return redirect()->route('perguntasopcao.show')
            ->with('mensagem', 'Opção cadastrada com sucesso!');
    }

    public function show(Option $request)
    {
        $options        = $request->all();

        $perguntas      = Question::all();

        // $options = $pergunta;

        // $options->id_pergunta = $pergunta->pergunta;
        // $options->id_pergunta = $pergunta->pergunta;
        // dd($pergunta);
        return view('perguntas.opcaoShow', [ 'perguntas' => $perguntas, 'options' => $options]);
        // return view('perguntas.opcaoShow', [ 'options' => $options ]);
    }
}
