<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Dev - 27/06/2022 - wss
    public function indexUsuarios() {
        return view('users.list');
    }

    public function buscaDados(Request $request)
    {
        //print_r($request->all());
        $draw               = $request->get('draw');// Iniciando tabela a ser mostrada
        $start              = $request->get("start");// Inicialização dos registros
        $rowPerPage         = $request->get("length");// Quantidade de registros por paginas

        $orderArray         = $request->get('order');// Array da coluna de ordenação
        $columnNameArray    = $request->get('columns');// Array da coluna nome

        $searchArray        = $request->get('search');// Array de busca
        $columnIndex        = $orderArray[0]['column'];// Array de index

        $columnName         = $columnNameArray[$columnIndex]['data'];// Armazena o Array dos nomes de acordo com os indexs

        $columnSortOrder    = $orderArray[0]['dir'];
        $searchValue        = $searchArray['value'];

        $users              = DB::table('users');
        $total              = $users->count();

        $totalFilter        = DB::table('users');

        if  (!empty($searchValue)) {
            $totalFilter    = $totalFilter->where('name','like','%'.$searchValue.'%');
            $totalFilter    = $totalFilter->orWhere('email','like','%'.$searchValue.'%');
        }

        $totalFilter        = $users->count();

        $arrData            = DB::table('users');
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Cadastrar usuário
    public function createUser()
    {
        // Chamar a view de cadastro
        return view('users.createUser');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        /**
         * Realiza consulta de email ou nome de usuário no banco
         * Se não existir realiza o cadastros
         * Se não retorna mensagem, cadastro já existe
         * */
        $consulta = User::where('email', $request->email)->first();
        $consulta = User::orWhere('name', $request->name)->first();
        // dd($consulta->email);
        if ($consulta === null) {
            User::create($request->all());
            return redirect()->route('user.list')
                ->with('mensagem', 'Cadastrado com sucesso!');
        } else {
            return back()->with('mensagem', 'Este usuário já existe!');
        }
    }
    /**
     * Mostra um registro especifico passando id pela rota
     */
    public function listUser(User $user)
    {
        // dd($user);
        return view('users.listUser', [
            'user' => $user
        ]);
    }
    /**
     * Chama a view de edição passando id pela rota
     */
    public function edit(User $user)
    {
        // dd($user);
        return view('users.editUser', [
            'user' => $user
        ]);
    }
    /**
     * Atualiza registro
     */
    public function update(UserRequest $request, User $user)
    {
        // $user -> $request;
        // dd($user);
        $user->update($request->all());
        return redirect()->route('users.listAll')->with('mensagem', 'Alteração realizada com sucesso!');
    }
    // Exclui registro
    public function excluir(User $user)
    {
        // Deletar registro
        {
            // dd($user);
            $user->delete();
            return back()->with('mensagem', 'Usuário excluído com sucesso!');
        }
    }
    // Mostrar Perguntas do usuário
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        // dd($user);
        if ($user) {
            echo "<h2>Dados do Usuário: </h2>";
            echo "<p>Nome: {$user->name} - Email: {$user->email}</p>";
        }
        $question = $user->listQuestions()->first();
        // dd($question);
        if ($question) {
            echo "<h3> Esta pergunta foi cadastrada pelo usuário {$user->name}</h3>";
            echo "<p> - Pergunta: {$question->question} </p>";
        }
    }
}
