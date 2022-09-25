<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Pesquisa;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesquisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaire::all();

        return view('pesquisas.index')
            ->with('questionnaires', $questionnaires);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idPesquisa)
    {
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

        $pesquisa = Pesquisa::create($request->all());

        // return $request->all();

        // $answer = new Answer;
        // $answer->questionnaire_id = $request->questionnaire_id;
        // $questionnaire = $request->questionnaire_id;
        // $question = $request->question_id;
        // $option = $request->option_id;
        // $comment = $request->comment;

        // Answer::create($request->all());

        // Answer::create([
        //     'questionnaire_id'  =>  $request->questionnaire_id,
        //     'question_id'       =>  implode(',', $request->question_id),
        //     'option_id'         =>  implode(',', $request->option_id),
        //     'comment'           =>  $request->comment

        // ]);

        // $answer = new Answer;
        // $answer->questionnaire_id  =  $request->questionnaire_id;
        // $answer->question_id       =  implode(',', $request->question_id);
        // $answer->option_id         =  implode(',', $request->option_id);
        // $answer->comment           =  $request->comment;
        // $answer->save();

        // return redirect()->back()
        // ->with('mensagem', "Pesquisa finalizada com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $pesquisa
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
     * @param  \App\Models\Answer  $pesquisa
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
