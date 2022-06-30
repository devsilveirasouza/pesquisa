<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Página padrão de início
    public function __invoke()
    {
        return view('home');
    }
}
