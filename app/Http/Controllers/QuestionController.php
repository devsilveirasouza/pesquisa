<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $pergunta;

    public function __construct(Question $pergunta)
    {
        $this->Pergunta = $pergunta;
    }
    //---------------------------------------------
    public function index()
    {
        $perguntas = Question::all();
        // return $perguntas;
        // $perguntas = Question::latest()->paginate();
        return view('perguntas.listarPerguntas')
            ->with(['perguntas' => $perguntas]);
    }
    //--------------Processamento ajax------------------------------------------------
    public function listagem()
    {
        return view('perguntas.listPergAjax');
    }
    //--------------Buscando informações e montando o datatables----------------------
    public function buscaDados(Question $question)
    {
        $perg1 = Question::all();

        $perg2 = Question::find(2);

        $item = "você";
        $busca = [];
        $question = Question::where('pergunta', 'like', '%'.$item.'%')->get();
        $busca['pergunta'] = $question;

        $q1 = Question::where('pergunta', 'Você encontrou tudo o que estava procurando?')->get();

        $q2 = Question::where('pergunta', 'Você recomendaria nossa loja?')->first();

        dump($perg1, $perg2, $busca, $q1, $q2);
        //--------------------------Estrutura de busca---------------------------------
        // $draw               = $pergunta->get('draw'); // Iniciando tabela a ser mostrada
        // $start              = $pergunta->get("start"); // Inicialização dos registros nas páginas
        // $rowPerPage         = $pergunta->get("length"); // Quantidade de registros por páginas

        // $orderArray         = $pergunta->get('order'); // Array da coluna de ordenação
        // $columnNameArray    = $pergunta->get('columns'); // Array da coluna pergunta

        // $searchArray        = $pergunta->get('search'); // Array de busca
        // $columnIndex        = $orderArray[0]['column']; // Array de index

        // $columnName         = $columnNameArray[$columnIndex]['data']; // Armazena o Array dos nomes de acordo com os indexs

        // $columnSortOrder    = $orderArray[0]['dir'];// Define a ordem dos registros: Crescente ou decrescente
        // $searchValue        = $searchArray['value'];
        // // //------------------Origem dos dados-------------------------------------------------
        // $questions          = $pergunta;// Atribui as informações do objeto na variável
        // $total              = $questions->count();// Busca o total de registros da tabela
        // // //------------------Filtra e Busca as informações no banco de dados------------------
        // // $totalFilter = $total;

        // $arrData            = $pergunta;
        // $arrData            = $arrData->get();

        // // $arrData            = $arrData->skip($start)->take($rowPerPage);
        // // $arrData            = $arrData->orderBy($columnName, $columnSortOrder);
        // // $totalFilter        = Question::all();// Atribui as informações da tabela na variável
        // // if (!empty($searchValue)) {
        // //     $totalFilter    = $totalFilter->where('pergunta','like','%'.$searchValue.'%');
        // //     $totalFilter    = $totalFilter->orWhere('usuario','like','%'.$searchValue.'%');
        // // }

        // // $totalFilter        = $questions->count();

        // // $arrData            = Question::all();
        // // $arrData            = $arrData->skip($start)->take($rowPerPage);
        // // $arrData            = $arrData->orderBy($columnName, $columnSortOrder);

        // // if (!empty($searchValue)) {
        // //     $arrData        = $arrData->where('pergunta','like','%'.$searchValue.'%');
        // //     $arrData        = $arrData->orWhere('usuario','like','%'.$searchValue.'%');
        // // }

        // // //-------------------------Retorna informações pro dataTable----------------------
        // $response = array(
        //     "draw"              => intval($draw),
        //     "recordsTotal"      => $total,
        //     "recordsFiltered"   => $totalFilter,
        //     "data"              => $arrData,
        // );

        // return response()->json($response);
    }
    //-----------------------------Cadastrar--------------------------------
    /**
     * Chama a view de cadastro de perguntas
     */
    public function create()
    {
        return view('perguntas.cadastrarPergunta');
    }

    public function cadastrarPergunta(Request $request)
    {
        $nova_pergunta = new Question();

        $nova_pergunta->pergunta = request('pergunta');
        $nova_pergunta->respObrigatoria = request('respObrigatoria');
        $nova_pergunta->tipoResposta = request('tipoResposta');
        $nova_pergunta->user_id = request('usuario');

        $nova_pergunta->save();
        return redirect()->route('perguntas.index')
            ->with('mensagem', 'Pergunta cadastrada com sucesso!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    /**
     * Mostra um registro especifico passando id pela rota
     */
    public function show(Question $pergunta)
    {
        /**
         * -- Consulta o id de usuario informado na pergunta e
         * busca o usuario e retorna o name da tabela Users
         **/
        $usuario = User::find($pergunta->user_id);
        $pergunta->usuario = $usuario->name;
        return view('perguntas.listPerg', ['pergunta' => $pergunta]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $pergunta)
    {
        return view('perguntas.editPerg', ['pergunta' => $pergunta]);
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
        $question = $request->all();
        dd($question);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function excluir(Question $question)
    {
        // dd($question);
        $question->delete();
        return back()->with('mensagem', 'Pergunta excluída com sucesso!');
    }
}
