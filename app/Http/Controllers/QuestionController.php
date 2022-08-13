<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;

class QuestionController extends Controller
{
    public function indexPerguntas()
    {
        return view('perguntas.index');
    }
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
            ->where('pergunta', 'like', '%' . $searchValue . '%')
            ->orWhere('tipoResposta', 'like', '%' . $searchValue . '%')
            ->count();
        // Buscar registros
        $records                    = Question::orderBy($columnName, $columnSortOrder)
            ->where('pergunta', 'like', '%' . $searchValue . '%')
            ->orWhere('tipoResposta', 'like', '%' . $searchValue . '%')
            ->select('questions.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        // Criando o array que vai receber as informações
        $data_arr = array();
        // Atribuindo as informações
        foreach ($records as $record) {
            $id                     = $record->id;
            $pergunta               = $record->pergunta;
            $respObrigatoria        = $record->respObrigatoria;
            $tipoResposta           = $record->tipoResposta;
            $usuario                = $record->user_id;
            $created_at             = \Carbon\Carbon::parse($record->created_at)->format('d/m/Y');

            // Criando os botões
            $btnEdit        = '<button type="button" value="' . $record->id . '" class="edit_pergunta btn btn-warning btn-sm ml-1">Editar</button>';
            // <a href="'.route('perguntas.edit', ['pergunta'=>$record->id]).'" class="btn btn-primary btn-sm col-sm-1 ml-2 mt-2" >Editar</a>
            $btnDelete      = '<button type="button" value="' . $record->id . '" class="delete_pergunta btn btn-danger btn-sm ml-1">Deletar</button>';
            $btnDetails     = '<button type="button" value="' . $record->id . '" class="details_pergunta btn btn-info btn-sm ml-1">Visualizar</button>';

            $buttons                = ['<nobr>' . $btnDetails . $btnEdit . $btnDelete . '</nobr>'];
            // Carregando as informações no array
            $data_arr[] = array(
                "id"                => $id,
                "pergunta"          => $pergunta,
                "respObrigatoria"   => $respObrigatoria,
                "tipoResposta"      => $tipoResposta,
                "usuario"           => $usuario,
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
        return view('perguntas.create');
    }
    // Cadastro
    public function store(Request $request)
    {
        // $question = $request->all();
        // dd($question);

        $nova_pergunta = new Question();
        $nova_pergunta->pergunta            = request('pergunta');
        $nova_pergunta->respObrigatoria     = implode(',', request('obrigatoria'));
        $nova_pergunta->tipoResposta        = implode(',', request('tipoResposta'));
        $nova_pergunta->user_id             = request('usuario');
        // dd($nova_pergunta);
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
    // public function edit(Question $pergunta)
    // {
    //     //dd($pergunta->respObrigatoria);
    //     return view('perguntas.edit', [
    //         'pergunta' => $pergunta
    //     ]);
    // }
    public function edit($id)
    {
        $perguntas = Question::where('id', $id)->get();

        return view('perguntas.edit', [
            'perguntas' => $perguntas
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pergunta = Question::find($request->id);
        $pergunta->pergunta             = $request->pergunta;
        $pergunta->respObrigatoria      = implode(',', $request->obrigatoria);
        $pergunta->tipoResposta         = implode(',', $request->tipoResposta);
        $pergunta->update();

        // return $pergunta;

        // $perguntas->pergunta            = request('pergunta');
        // $perguntas->respObrigatoria     = implode(',', request('obrigatoria'));
        // $perguntas->tipoResposta        = implode(',', request('tipoResposta'));
        // $perguntas->user_id             = request('usuario');
        // $perguntas->update();

        return redirect()->route('perguntas.index')
            ->with('mensagem', 'Atualização realizada com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function excluir($id)
    {
        // dd($id);
        $pergunta = Question::find($id);
        $pergunta->delete();

        return redirect()->route('perguntas.index')
            ->with(response()->json([
                'status' => 200,
                'message' => 'Pergunta excluída com sucesso!',
            ]));
    }
}
