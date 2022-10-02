<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Api\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = DB::table('option_question')
            ->select('questions.id as question_id', 'questions.titulo as question', 'questions.obrigatoria as QuestionObrigatoria', 'questions.tipo as QuestionTipo', 'options.titulo as OptionTitle')
            ->leftJoin('questions', 'questions.id', 'option_question.question_id')
            ->leftJoin('options', 'options.id', 'option_question.option_id')
            ->get();

        $data_arr = array();

        foreach($questions as $question) {
            $question_id        = $question->question_id;
            $question_titulo    = $question->question_titulo;
            $option_title       = $question->option_title;
            $comment            = $question->comment;
            $user_name          = $question->user_name;
        }

        return $questions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return $question;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
