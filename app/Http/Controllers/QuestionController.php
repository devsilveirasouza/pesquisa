<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index()
    {
        return ("Chegamos no index!");
    }

    public function criarPergunta()
    {
        return ("Tela: perguntas cadastrarPergunta");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarPergunta(Request $request)
    {
        dd($request->all());
        // $pergunta = $request->all();
        // dd($pergunta);
        // $insert = [
        //     // Tabela de perguntas
        //     'question'      => $request->pergunta,
        //     'usuario'       => $request->usuario,
        //     'mandatory'     => $request->obrigatorio,
        //     'options'       => $request->tipoResposta,
        //     // Tabela de Opções
        //     'option' => implode(',', $request->option),
        // ];
        //dd($insert);
        //DB::table('questions')->insert($insert);
        //foreach($request->radio as $key => $name);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
