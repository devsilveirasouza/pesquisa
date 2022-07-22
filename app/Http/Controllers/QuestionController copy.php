<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;

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
    public function buscaDados(Request $request)
    {
        // print_r($request);
        $draw               = $request->get('draw');// Iniciando tabela a ser mostrada
        // dd($draw);
        $start              = $request->get("start");// Inicialização dos registros
        $rowPerPage         = $request->get("length");// Quantidade de registros por paginas

        $orderArray         = $request->get('order');// Array da coluna de ordenação
        $columnNameArray    = $request->get('columns');// Array da coluna name

        $searchArray        = $request->get('search');// Array de busca
        $columnIndex        = $orderArray[0]['column'];// Array de index

        $columnName         = $columnNameArray[$columnIndex]['data'];// Armazena o Array dos nomes de acordo com os indexs

        $columnSortOrder    = $orderArray[0]['dir'];
        $searchValue        = $searchArray['value'];

        $questions          = DB::table('questions');
        $total              = $questions->count();

        $totalFilter        = DB::table('questions');

        if  (!empty($searchValue)) {
            $totalFilter    = $totalFilter->where('name','like','%'.$searchValue.'%');
            $totalFilter    = $totalFilter->orWhere('email','like','%'.$searchValue.'%');
        }

        $totalFilter        = $questions->count();

        $arrData            = DB::table('questions');
        $arrData            = $arrData->skip($start)->take($rowPerPage);
        $arrData            = $arrData->orderBy($columnName, $columnSortOrder);

        if  (!empty($searchValue)) {
            $arrData        = $arrData->where('name','like','%'.$searchValue.'%');
            $arrData        = $arrData->orWhere('email','like','%'.$searchValue.'%');
        }

        $arrData            = $arrData->get();

        $response = array(
            "draw"              => intval($draw),
            "recordsTotal"      => $total,
            "recordsFiltered"   => $totalFilter,
            "data"              => $arrData,
        );

        return response()->json($response);
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
    public function update(Request $request, Question $pergunta)
    {
        // $pergunta->$request;
        // dd($pergunta);
        $pergunta->update($request->all());
        return redirect()->route('perguntas.index')
            ->with('mensagem', 'Atualização realizada com sucesso!');
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
