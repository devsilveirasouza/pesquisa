<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateQuestionRequest;
use App\Models\Answer;
use App\Models\Option;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    // Chama view principal das perguntas
    public function index()
    {
        return view('admin.questions.index');
    }
    // Realiza a busca e monta os dados do datatable
    public function buscaDados(Request $request)
    {
        ## Leitura dos valores
        $draw                       = $request->get('draw');
        $start                      = $request->get('start');
        $rowperpage                 = $request->get('length'); // Exibição de linhas por págima

        $columnIndex_arr            = $request->get('order');
        $columnName_arr             = $request->get('columns');
        $order_arr                  = $request->get('order');
        $search_arr                 = $request->get('search');

        $columnIndex                = $columnIndex_arr[0]['column']; // Indice da coluna
        $columnName                 = $columnName_arr[$columnIndex]['data']; // Nome da coluna
        $columnSortOrder            = $order_arr[0]['dir']; // Definir ordenação das informações asc ou desc
        $searchValue                = $search_arr['value']; // Valor da pesquisa
        // Total de registros
        $totalRecords               = Question::select('count(*) as allcount')->count();
        // Total de registros com filtros
        $totalRecordswithFilter     = Question::select('count(*) as allcount')
            ->where('titulo', 'like', '%' . $searchValue . '%')
            ->orWhere('tipo', 'like', '%' . $searchValue . '%')
            ->count();
        // Buscar registros
        $records                    = Question::orderBy($columnName, $columnSortOrder)
            ->where('titulo', 'like', '%' . $searchValue . '%')
            ->orWhere('tipo', 'like', '%' . $searchValue . '%')
            ->select('questions.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // Criando o array que vai receber as informações
        $data_arr = array();
        // Atribuindo as informações
        foreach ($records as $record) {
            $id                     = $record->id;
            $titulo                 = $record->titulo;
            $obrigatoria            = $record->obrigatoria;
            $tipo                   = $record->tipo;
            $user_id                = $record->user_id;

            $created_at             = \Carbon\Carbon::parse($record->created_at)->format('d/m/Y');

            // Criantipodo os botões
            $btnEdit        = '<button type="button" value="' . $id . '" class="edit_pergunta btn btn-warning btn-sm ml-1">Edit</button>';
            $btnDelete      = '<button type="button" value="' . $id . '" class="delete_pergunta btn btn-danger btn-sm ml-1">Delete</button>';
            $btnDetails     = '<button type="button" value="' . $id . '" class="details_pergunta btn btn-info btn-sm ml-1">Detaills</button>';

            $buttons                = ['<nobr>' . $btnDetails . $btnEdit . $btnDelete . '</nobr>'];
            // Carregando as informações no array
            $data_arr[] = array(
                "id"                => $id,
                "titulo"            => $titulo,
                "obrigatoria"       => $obrigatoria,
                "tipo"              => $tipo,
                "user_id"           => $user_id,
                "created_at"        => $created_at,
                "buttons"           => $buttons
            );
        }
        // Envio das informações
        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordswithFilter,
            "aaData"                => $data_arr
        );
        echo json_encode($response);
        exit;
    }
    //-----------------------------Cadastrar--------------------------------
    /**
     * Chama a view de cadastro de perguntas
     */
    public function create()
    {
        $options = Option::all();

        return view('admin.questions.create')
            ->with('options', $options);
    }
    // Cadastrar os dados no banco
    public function store(StoreUpdateQuestionRequest $request)
    {

        DB::beginTransaction();
        // Recuperando o dado inserido no banco
        $question = Question::create($request->all());
        // Verifica se se existe um campo chamado options na requisição
        if ($request->has('options')) {
            /** chamando o relacionamento (options)
             * attach => adicione (aceita array de ids) => somente adiciona
             *  */
            // $question->options()->attach($request->options);
            /** sync => atualiza o registro dos relacionamentos */
            $question->options()->sync($request->options);
        }

        DB::commit();

        return redirect()->route('perguntas.index')
            ->with('mensagem', 'Pergunta cadastrada com sucesso!');
    }
    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Question  $question
    //  * @return \Illuminate\Http\Response
    //  */
    // /**
    //  * Mostra um registro especifico passando id pela rota
    //  */

    public function show($id)
    {
        /**
         * -- Consulta o id de usuario informado na pergunta e
         * busca o usuario e retorna o name  Users
         **/
        $question = Question::with(['user', 'options'])->find($id);

        $user       =   User::all();
        $options    =   Option::all();

        return view('admin.questions.show')
            ->with('question', $question)
            ->with('user', $user)
            ->with('options', $options);
    }
    /**
     * Chama o formulário para editar os dados */
    public function edit($id)
    {
        $question = Question::with(['user', 'options'])->find($id);

        $user = User::all();
        $options = Option::all();

        return view('admin.questions.edit')
            ->with('question', $question)
            ->with('user', $user)
            ->with('options', $options);
    }
    /**
     * Atualiza os dados enviados pelo formulário de edição
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);

        DB::beginTransaction();

        $question->update($request->all());

        if ($request->has('options')) {
            $question->options()->sync($request->options);
        }

        DB::commit();

        return redirect()->route('perguntas.index')
            ->with('mensagem', 'Atualização realizada com sucesso!');
    }
    /**
     * Exclui um registro.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function excluir(Request $request, $id)
    {
        $question = Question::find($id);

        DB::beginTransaction();

        $question->delete();

        DB::commit();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Pergunta excluída com sucesso!',
        ]);
    }
    //  --- Pesquisa --- ///
    public function startquiz()
    {

        Session::put('nextq', '1');

        $question = Question::all()->first();

        return view('site.answer')->with(['question' => $question]);
    }
    public function submitans(Request $request)
    {
        $i_opt = 0;

        return $answer = $request->all();

        foreach ($answer as $option_id) {

            $i_opt = +1;

            if ($option_id->count < $i_opt) {
                Answer::create($request->all());
            }

            if ($option_id->count == $i_opt) {
                Answer::create([
                    'question_id'       =>  $request->question_id,
                    'option_id'         =>  $option_id[$i_opt],
                    'comment'           =>  $request->comment
                ]);
            }
        }

        // Salvar resposta no DB


        // Inicializar index
        $nextq = 0;

        $nextq = Session::get('nextq');
        $nextq += 1;

        Session::put('nextq', $nextq);

        $i_q = 0;

        $questions = Question::all();

        foreach ($questions as $question) {

            $i_q++;

            if ($questions->count() < $nextq) {
                return view('site.end');
            }

            if ($i_q == $nextq) {
                return view('site.answer')->with(['question' => $question]);
            }
        }
    }
}
