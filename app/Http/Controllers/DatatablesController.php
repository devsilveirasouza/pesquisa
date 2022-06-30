<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class DatatablesController extends Controller
{
    public function index()
    {

        return view('users.index');
    }

    public function ajaxList(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2=> 'email',
            3=> 'options',
        );

        $pagina = 1;
        $maximo = 5;
        $inicio = (($maximo * $pagina) - $maximo);


        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $data = array();
        if (!empty($users)) {
            foreach ($users as $user) {
                $show =  route('posts.show', $user->id);
                $edit =  route('posts.edit', $user->id);
                $nestedData['id'] = $user->id;
                $nestedData['name'] = $user->title;
                $nestedData['email'] = $user->email;
                $nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
                                          &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function indexData() {
        return view('list');
    }
    // Pagination with ajax server side
    public function getData(Request $request)
    {
        $draw = $request->get;
        $start = $request->get;
        $rowPerPage = $request->get;

       $users = DB::table('users')::table('users');
       $total = $users->count();

       $totalFilter = $total;

       $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFilter,
            "data" => $arrData,
        );
        //echo json_encode($users);
    }
}
