<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Option;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AnswerController extends Controller
{
    public function index() {
        return view('respostas.index');
    }

    public function getResponse(Request $request)   {
        // Leitura dos valores
        $draw                       = $request->get('draw');
        $start                      = $request->get('start');
        $rowPerPage                 = $request->get('length');          // Exibição de linhas por págima

        $columnIndex_arr            = $request->get('order');
        $columnName_arr             = $request->get('columns');
        $order_arr                  = $request->get('order');
        $search_arr                 = $request->get('search');

        $columnIndex                = $columnIndex_arr[0]['column'];            // Indice da coluna
        $columnName                 = $columnName_arr[$columnIndex]['data'];    // Nome da coluna
        $columnSortOrder            = $order_arr[0]['dir'];                     // Define a ordenação das informações 'asc' ou 'desc'
        $searchValue                = $search_arr['value'];                     // Valor da pesquisa

        // Retorna todos os registros
        $totalRecords               = Answer::select('count(*) as allcount')->count();

        // Filtrar resultados
        $totalRecordsWithFilter     = Answer::select('count(*) as allcount')
            ->where('questions.titulo', 'like', '%' . $searchValue . '%')
            ->select('questions.titulo as question_id')
            ->leftJoin('questions', 'questions.id', 'answers.question_id')
            ->count();

        // Carrega dados do banco
        $records = Answer::orderBy($columnName, $columnSortOrder)
            ->where('questions.titulo', 'like', '%' . $searchValue . '%')
            ->select('questions.id as question_id', 'questions.titulo as question_titulo', 'options.titulo as option_title', 'answers.comment', 'users.name as user_name')
            ->leftJoin('questions', 'questions.id', 'answers.question_id')
            ->leftJoin('options', 'options.id', 'answers.option_id')
            ->leftJoin('users', 'users.id', 'answers.user_id')
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        // Array que vai receber os dados
        $data_arr = array();

        foreach ($records as $record) {
            $question_id        = $record->question_id;
            $question_titulo    = $record->question_titulo;
            $option_title       = $record->option_title;
            $comment            = $record->comment;
            $user_name          = $record->user_name;
            $created_at         = \Carbon\Carbon::parse($record->created_at)->format('d/m/Y');

            $btnDetails = '<a href="' . route('resposta.show', [$record->question_id]) . '"><button value="' . $question_id . '" class="btnDetails btn btn-xs btn-dark text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button></a>';

            $buttons            = ['<nobr>' . $btnDetails . '</nobr>'];

            // Carregando as informações no array
            $data_arr[]     = array(
                "question_id"               => $question_id,
                "question_titulo"           => $question_titulo,
                "option_title"              => $option_title,
                "comment"                   => $comment,
                "user_name"                 => $user_name,
                "created_at"                => $created_at,
                "buttons"                   => $buttons
            );
        }

        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordsWithFilter,
            "aaData"                => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    public function show($id)
    {
        $answers = DB::table('answers')
            ->where('answers.question_id', '=', $id)
            ->select('questions.id as question_id', 'questions.titulo as question_titulo', 'options.titulo as option_id', 'answers.comment', 'users.name as user_id')
            ->leftJoin('questions', 'questions.id', 'answers.question_id')
            ->leftJoin('options', 'options.id', 'answers.option_id')
            ->leftJoin('users', 'users.id', 'answers.user_id')
            ->get();

        return view('respostas.show')
            ->with('answers', $answers);
    }
}
