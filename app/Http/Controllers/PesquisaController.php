<?php

namespace App\Http\Controllers;

use App\Models\Pesquisa;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class PesquisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesquisas              = Pesquisa::with(['questionnaires','questions']);

        $questionnaires = Questionnaire::all();
        $questions      = Question::all();

        return view('pesquisas.index')
            ->with('pesquisas', $pesquisas)
            ->with('questionnaires', $questionnaires)
            ->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idPesquisa)
    {

        // return $idPesquisa;

        $questionnaire = Questionnaire::with('questions')->find($idPesquisa);

        $questions = Question::all();

        return view('pesquisas.create')
            ->with('questionnaire', $questionnaire)
            ->with('questions', $questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesquisa  $pesquisa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesquisa = Pesquisa::with(['questionnaires', 'questions'])->find($id);

        $questionnaires       =   User::all();
        $options    =   Option::all();

        return view('admin.questions.show')
            ->with('question', $question)
            ->with('user', $user)
            ->with('options', $options);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesquisa  $pesquisa
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesquisa $pesquisa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesquisa  $pesquisa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesquisa $pesquisa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesquisa  $pesquisa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesquisa $pesquisa)
    {
        //
    }
}
