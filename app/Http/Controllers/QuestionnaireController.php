<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaire::all();

        return view('admin.questionnaires.index')
            ->with('questionnaires', $questionnaires);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::all();

        return view('admin.questionnaires.create')
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

         DB::beginTransaction();

         $questionnaire = Questionnaire::create($request->all());

         if ($request->has('questions')) {

            $questionnaire->questions()->sync($request->questions);
        }

        DB::commit();

         return redirect()->route('questionnaires.index')
            ->with('mensagem', "Cadastro realizado com sucesso!");
    }

    /**
     * Mostra o formulário para editar um registro específico.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questionnaire  = Questionnaire::with('questions')->find($id);

        $questions        = Question::all();

        return view('admin.questionnaires.edit')
            ->with('questionnaire', $questionnaire)
            ->with('questions', $questions);
    }

    /**
     * Atualiza um registro específico enviado pelo formulário de edição.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $questionnaire = Questionnaire::find($id);

        DB::beginTransaction();

        $questionnaire->update($request->all());

        if ($request->has('questions')) {
            $questionnaire->questions()->sync($request->questions);
        }

        DB::commit();

        return redirect()->route('questionnaires.index')
            ->with('mensagem', "Registro atualizado com sucesso!");
    }

    /**
     * Exclui um registro específico do DB.
     *
     * @param  \App\Models\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $questionnaire = Questionnaire::find($id);

        DB::beginTransaction();

        $questionnaire->delete();

        DB::commit();

        $request->session()->flash('mensagem', "Registro excluído com sucesso!");
        return redirect()->route('questionnaires.index');

    }
    public function show($id)
    {
        $questionnaire = Questionnaire::with('questions')->find($id);

        $questions = Question::all();

        return view('admin.questionnaires.show')
            ->with('questionnaire', $questionnaire)
            ->with('questions', $questions);

    }
}
