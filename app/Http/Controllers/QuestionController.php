<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    protected $pergunta;

    public function __construct(Question $pergunta)
    {
        $this->pergunta = $pergunta;
    }
    //---------------------------------------------
    public function index()
    {
        // $perguntas = Question::all();
        // return $perguntas;
        $perguntas = Question::latest()->paginate();
        return view('perguntas.listarPerguntas')
            ->with(['perguntas' => $perguntas]);
    }
    //--------------Processamento ajax------------------------------------------------
    public function listagem()
    {
        return view('perguntas.listPergAjax');
    }
    //--------------Buscando informações e montando o datatables----------------------
    public function buscaDados(Question $request)
    {
        // print_r($request->all());// Está chegando nullo
        // $pergs = $request->all();
        // dd($pergs);
        //--------------------------Estrutura de busca---------------------------------
        $draw               = $request->get('draw');// Iniciando tabela a ser mostrada
        $start              = $request->get("start");// Inicialização dos registros
        $rowPerPage         = $request->get("length");// Quantidade de registros por paginas

        $orderArray         = $request->get('order');// Array da coluna de ordenação
        $columnNameArray    = $request->get('columns');// Array da coluna pergunta

        $searchArray        = $request->get('search');// Array de busca
        $columnIndex        = $orderArray[0]['column'];// Array de index

        $columnName         = $columnNameArray[$columnIndex]['data'];// Armazena o Array dos nomes de acordo com os indexs

        $columnSortOrder    = $orderArray[0]['dir'];
        $searchValue        = $searchArray['value'];

        $questions          = DB::table('questions');
        $total              = $questions->count();

        $totalFilter        = DB::table('questions');
        //------------------Busca informações no dataTables----------------------------------
        if  (!empty($searchValue)) {
            $totalFilter    = $totalFilter->where('pergunta','like','%'.$searchValue.'%');
            // $totalFilter    = $totalFilter->orWhere('usuario','like','%'.$searchValue.'%');
        }

        $totalFilter        = $questions->count();

        $arrData            = DB::table('questions');
        $arrData            = $arrData->skip($start)->take($rowPerPage);
        $arrData            = $arrData->orderBy($columnName, $columnSortOrder);

        if  (!empty($searchValue)) {
            $arrData        = $arrData->where('pergunta','like','%'.$searchValue.'%');
            // $arrData        = $arrData->orWhere('usuario','like','%'.$searchValue.'%');
        }

        $arrData            = $arrData->get();
        //-------------------------Retorna informações pro dataTable----------------------
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

        $nova_pergunta->pergunta         = request('pergunta');
        $nova_pergunta->respObrigatoria  = request('respObrigatoria');
        $nova_pergunta->tipoResposta     = request('tipoResposta');
        $nova_pergunta->usuario          = request('usuario');

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
        $usuario = User::find($pergunta->usuario);
        $pergunta->usuario = $usuario->name;
        return view('perguntas.listPerg', [ 'pergunta' => $pergunta ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
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
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
