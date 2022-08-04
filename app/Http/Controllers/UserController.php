<?php

namespace App\Http\Controllers;

use Illuminate\Support\HtmlString;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Dev - 27/06/2022 - wss
    public function indexUsuarios()
    {
        return view('users.listUsers');
    }

    public function buscaDados(Request $request)
    {
        $draw = $request->get('draw'); // Iniciando tabela a ser mostrada
        $start = $request->get("start"); // Inicialização dos registros
        $rowPerPage = $request->get("length"); // Quantidade de registros por paginas

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Indice da coluna
        $columnName = $columnName_arr[$columnIndex]['data']; // Nome da coluna
        $columnSortOrder = $order_arr[0]['dir']; // Definir ordenação das informações asc ou desc
        $searchValue = $search_arr['value']; // Valor da pesquisa

        $totalRecords = User::select('count(*) as allcount')->count();

        $totalRecordswithFilter = User::select('count(*) as allcount')
            ->where('users.name', 'like', '%' . $searchValue . '%')
            ->orWhere('users.email', 'like', '%' . $searchValue . '%')
            ->count();

        $users = User::orderBy($columnName, $columnSortOrder)
            ->where('users.name', 'like', '%' . $searchValue . '%')
            ->orWhere('users.email', 'like', '%' . $searchValue . '%')
            ->select('users.*')
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = array();

        foreach ($users as $user) {
            $id = $user->id;
            $nome = $user->name;
            $email = $user->email;

            // Criando os botões
            $btnEdit = '<a href="javascript:void(0)" id="userEdit" data-id="' . $user->id . '"
                class="btn btn-warning btnEdit mx-1 shadow " title="Edit">Edit</a>';
            $btnDelete = '<a href="javascript:void(0)" id="userDelete" data-id="' . $user->id . '" type="submit"
                class="btn btn-danger btnDelete mx-1 shadow " title="Delete">Delete</a>';
            $btnDetails = '<a href="javascript:void(0)" id="userDetails" data-id="' . $user->id . '"
                class="btn btn-primary btnDetails mx-1 shadow " title="Details">View</a>';

            $buttons = ['<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'];

            $data_arr[] = array(
                "id" => $id,
                "name" => $nome,
                "email" => $email,
                "buttons" => $buttons
            );
        }
        // Envio das informações
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );
        echo json_encode($response);
        exit;
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
        return redirect()->route('user.list')->with('mensagem', 'Alteração realizada com sucesso!');
    }
    // Exclui registro
    public function excluir(User $user)
    { {
            $user->delete();
            // dd($user);
            return redirect()->route('user.list')->with('mensagem', 'Usuário excluído com sucesso!');
        }
    }
    // Mostrar Perguntas do usuário
    public function show($id)
    {
        $user = User::find($id);
        // dd($user);
        return view('users.listUser', ['user' => $user]);
    }
}
