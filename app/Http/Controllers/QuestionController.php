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
        foreach ($records as $question) {
            $id                     = $question->id;
            $titulo                 = $question->titulo;
            $obrigatoria            = $question->obrigatoria;
            $tipo                   = $question->tipo;
            $user_id                = $question->user_id;

            $created_at             = \Carbon\Carbon::parse($question->created_at)->format('d/m/Y');

            // Criando os botões
            $btnEdit        = '<a href="' . route('perguntas.edit', [$question->id]) . '"><button value="' . $question->id . '" class="edit_pergunta btn btn-xs btn-default text-primary mx-1 shadow"><i class="fa fa-lg fa-fw fa-pen"></i></button></a>';
            $btnDelete      = '<button value="' . $question->id . '" class="delete_pergunta btn btn-xs btn-default text-danger mx-1 shadow"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
            $btnDetails     = '<a href="' . route('pergunta.listar', [$question->id]) . '"><button value="' . $question->id . '" class="details_pergunta btn btn-xs btn-default text-teal mx-1 shadow"><i class="fa fa-lg fa-fw fa-eye"></i></button></a>';

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
    public function create()
    {
        $options = Option::all();

        return view('admin.questions.create')
            ->with('options', $options);
    }
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
        // $answer = Answer::where('question_id', $id);
        // if ($answer) {
        //     //Se for encontrado os parametros retorna mensagem abaixo
        //     return back()->with('mensagem', "Pergunta já respondida, não é possível mais alterar.");
        // } else {
            DB::beginTransaction();
            $question->update($request->all());
            if ($request->has('options')) {
                $question->options()->sync($request->options);
            }
            DB::commit();
            return redirect()->route('perguntas.index')
                ->with('mensagem', 'Atualização realizada com sucesso!');
        // }
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
        $answer = Answer::where('question_id', $id);
        if ($answer) {
            //Se for encontrado os parametros retorna mensagem abaixo
            return back()->with('mensagem', "Não foi possível excluír este registro.");
        } else {
            DB::beginTransaction();
            $question->delete();
            DB::commit();
            return back()->with('mesagem', "Registro excluído com sucesso!");
        }
    }
    //  --- Pesquisa --- ///
    //  Acessar as pesquisas de forma publica   //
    public function pesquisa()
    {
        return view('site.index');
    }
    public function startquiz()
    {
        Session::put('nextq', '1');

        $question = Question::all()->first();

        return view('site.answer')->with(['question' => $question]);
    }
    public function submitans(Request $request)
    {
        $i_opt = 0;

        if (!isset($request->option_id)) {

            Answer::create($request->all());
        } elseif (count($request->option_id)  <= 1) {

            Answer::create([
                'question_id'       =>  $request->question_id,
                'option_id'         =>  $request->option_id[$i_opt],
                'comment'           =>  $request->comment,
                'user_id'           =>  $request->user_id
            ]);
        } else {
            // echo "<pre>";
            // print_r($request->all());
            $i = 0;
            for ($i_o = 0; $i_o < count($request->option_id); $i_o++) {

                $answer = new Answer;
                $answer->question_id    = $request->question_id;
                $answer->option_id      = $request->option_id[$i];
                $answer->comment        = $request->comment;
                $answer->user_id        = $request->user_id;
                $answer->save();
                $i++;
            }
        }
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
