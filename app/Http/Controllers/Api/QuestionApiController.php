<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Cache\NullStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class QuestionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = Question::with(['options']);

        return QuestionResource::collection($question->get())->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitAns(Request $request)
    {
        $question = Question::find($request);
        $mandatory = true;

        if ($question[0]->obrigatoria == "Sim") {
            $mandatory = true;
        } else {
            $mandatory = false;
        }

        $array = ['error' => ''];

        $rules = [
            'question_id' => 'required',
            'user_id'       => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] =   $validator->messages();
            return $array;
        }

        $i_opt = 0; // Index option
        $question_id    = $request->input('question_id');
        $option_id      = $request->input('option_id');
        $comment        = $request->input('comment');
        $user_id        = $request->input('user_id');

        // Comment validation
        if (is_null($request->option_id)) {
            if ($mandatory == false) {
                $answer = new Answer();
                $answer->question_id    = $question_id;
                $answer->comment        = $comment;
                $answer->user_id        = $user_id;
                $answer->save();
                // return $array;
                return response()->json([
                    'status'    => 200,
                    'message'   =>  'Success'
                ]);
            } else {
                if ($mandatory == true and $comment != null) {
                    $answer = new Answer();
                    $answer->question_id    = $question_id;
                    $answer->comment        = $comment;
                    $answer->user_id        = $user_id;
                    $answer->save();
                    // return $array;
                    return response()->json([
                        'status'    => 200,
                        'message'   =>  'Success',
                    ]);
                }
            }
            // Option validation
        } elseif (count($request->option_id) <= 1) {
            if ($mandatory == false) {
                $answer = new Answer();
                $answer->question_id    = $question_id;
                $answer->option_id      = $option_id[$i_opt];
                $answer->user_id        = $user_id;
                $answer->save();
                // return $array;
                return response()->json([
                    'status'    => 200,
                    'message'   =>  'Success'
                ]);
            } else {
                if ($mandatory == true and $option_id != null) {
                    $answer = new Answer();
                    $answer->question_id    = $question_id;
                    $answer->option_id      = $option_id[$i_opt];
                    $answer->user_id        = $user_id;
                    $answer->save();
                    // return $array;
                    return response()->json([
                        'status'    => 200,
                        'message'   =>  'Success'
                    ]);
                }
            }
            // Options multiple validation
        } else {
            if ($mandatory == false) {
                $i = 0;
                for ($i_o = 0; $i_o < count($request->option_id); $i_o++) {
                    $answer = new Answer;
                    $answer->question_id    = $request->question_id;
                    $answer->option_id      = $request->option_id[$i];
                    $answer->user_id        = $request->user_id;
                    $answer->save();
                    $i++;
                }
                // return $array;
                return response()->json([
                    'status'    => 200,
                    'message'   =>  'Success'
                ]);
            } else {
                if ($mandatory == true and $option_id != null) {
                    $i = 0;
                    for ($i_o = 0; $i_o < count($request->option_id); $i_o++) {
                        $answer = new Answer;
                        $answer->question_id    = $request->question_id;
                        $answer->option_id      = $request->option_id[$i];
                        $answer->user_id        = $request->user_id;
                        $answer->save();
                        $i++;
                    }
                    // return $array;
                    return response()->json([
                        'status'    => 200,
                        'message'   =>  'Success'
                    ]);
                }
            }
        }
        return response()->json((['message' => 'Register Failed']), 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $question
     * @return \Illuminate\Http\Response
     */

    public function show(Question $question)
    {
        $question = Question::find($question)->first();
        if (is_null($question)) {
            return response()->json((['message' => 'Question Not Found']), 404);
        }
        return (new QuestionResource($question->loadMissing(['options'])))->response();
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
}
