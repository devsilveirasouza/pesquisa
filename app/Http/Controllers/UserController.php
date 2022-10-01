<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Dev - 27/06/2022 - wss
    public function indexUsuarios()
    {
        return view('admin.users.index');
    }
    public function buscaDados(Request $request)
    {
        $draw                       = $request->get('draw'); // Iniciando tabela a ser mostrada
        $start                      = $request->get("start"); // Inicialização dos registros
        $rowPerPage                 = $request->get("length"); // Quantidade de registros por paginas

        $columnIndex_arr            = $request->get('order');
        $columnName_arr             = $request->get('columns');
        $order_arr                  = $request->get('order');
        $search_arr                 = $request->get('search');

        $columnIndex                = $columnIndex_arr[0]['column']; // Indice da coluna
        $columnName                 = $columnName_arr[$columnIndex]['data']; // Nome da coluna
        $columnSortOrder            = $order_arr[0]['dir']; // Definir ordenação das informações asc ou desc
        $searchValue                = $search_arr['value']; // Valor da pesquisa

        $totalRecords               = User::select('count(*) as allcount')->count();

        $totalRecordswithFilter     = User::select('count(*) as allcount')
            ->where('users.name', 'like', '%' . $searchValue . '%')
            ->orWhere('users.email', 'like', '%' . $searchValue . '%')
            ->count();

        $users                      = User::orderBy($columnName, $columnSortOrder)
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
            $btnEdit        = '<a href="' . route('user.edit', [$user->id]) . '"><button value="' . $user->id . '" class="edit_user btn btn-xs btn-default text-primary mx-1 shadow"><i class="fa fa-lg fa-fw fa-pen"></i></button></a>';
            $btnDelete      = '<button value="' . $user->id . '" class="delete_user btn btn-xs btn-default text-danger mx-1 shadow"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
            $btnDetails     = '<a href="' . route('user.listUser', [$user->id]) . '"><button value="' . $user->id . '" class="details_user btn btn-xs btn-default text-teal mx-1 shadow"><i class="fa fa-lg fa-fw fa-eye"></i></button></a>';

            $buttons = ['<nobr>' . $btnDetails . $btnEdit . $btnDelete . '</nobr>'];

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
        return view('admin.users.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Realiza o cadastro do registro
    public function store(UserRequest $request)
    {

        $email      = User::where('email', $request->email)->first();
        $name       = User::Where('name', $request->name)->first();

        if ($email == null and $name == null) {

            DB::beginTransaction();

            User::create($request->all());

            DB::commit();

            return redirect()->route('user.list')
                ->with('mensagem', 'Cadastrado com sucesso!');
        } else {
            return back()->with('mensagem', 'Este usuário ou email já existe!');
        }
    }
    /**
     * Chama a view de edição passando id pela rota
     */
    public function edit(User $user)
    {

        return view('admin.users.edit')
            ->with('user', $user);
    }
    /**
     * Atualiza registro
     */
    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();

        $user->update($request->all());

        DB::commit();

        return redirect()->route('user.list')
            ->with('mensagem', 'Alteração realizada com sucesso!');
    }
    // Excluir registro
    public function excluir($id)
    {
        $user = User::find($id);

        DB::beginTransaction();

        $user->delete();

        DB::commit();

        return response()->json([
            'status'    => 200,
            'message'   => 'Usuário excluído com sucesso!',
        ]);
    }
    // Mostra registro
    public function show($id)
    {
        $user = User::find($id);
        //dd($user);
        return view('admin.users.show', ['user' => $user]);
    }
}
