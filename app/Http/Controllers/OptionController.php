<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;

class OptionController extends Controller
{
    public function index()
    {
        $perguntas = Question::all();

        return view('perguntas.opcaoPergunta')
            ->with(['perguntas' => $perguntas]);
    }
}

// $usuario = User::find($pergunta->user_id);
// $pergunta->usuario = $usuario->name;
