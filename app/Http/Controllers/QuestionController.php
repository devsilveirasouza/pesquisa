<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;

class QuestionController extends Controller
{    public function index()    {
        return view('perguntas.index');
    }
    public function getQuestion(Request $request)    {
        ## Leitura dos valores
        $draw = $request->get('draw');
        $start = $request->get('start');
        $rowperpage = $request->get('length'); // Exibição de linhas por págima

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Indice da coluna
        $columnName = $columnName_arr[$columnIndex]['data']; // Nome da coluna
        $columnSortOrder = $order_arr[0]['dir']; // Definir ordenação das informações asc ou desc
        $searchValue = $search_arr['value']; // Valor da pesquisa

        // Total de registro
        $totalRecords = Question::select('count(*) as allcount')->count();

        $totalRecordswithFilter = Question::select('count(*) as allcount')
            ->where('pergunta', 'like', '%' . $searchValue . '%')
            ->count();
        // Buscar registros
        $records = Question::orderBy($columnName, $columnSortOrder)
            ->where('questions.pergunta', 'like', '%' . $searchValue . '%')
            ->select('questions.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $pergunta = $record->pergunta;
            $respObrigatoria = $record->respObrigatoria;
            $tipoResposta = $record->tipoResposta;
            $usuario = $record->user_id;
            $created_at = $record->created_at;
            $buttons = '<a href="#" class="btn btn-warning btn-sm ml-2 mt-2">
                        <i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm ml-2 mt-2">
                        <i class="fas fa-trash"></i></a>';
            $data_arr[] = array(
                "id" => $id,
                "pergunta" => $pergunta,
                "respObrigatoria" => $respObrigatoria,
                "tipoResposta" => $tipoResposta,
                "usuario" => $usuario,
                "created_at" => $created_at,
                "buttons" => $buttons
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
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
