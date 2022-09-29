<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PesquisaController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/',                                      HomeController::class);
// -------------------------------------Usuarios-----------------------------------------------------------------------------------------
Route::get('/usuarios',                             [UserController::class,     'indexUsuarios'])->Middleware('auth')->name('user.list');
Route::get('/usuarios-listagem',                    [UserController::class,     'buscaDados'])->Middleware('auth')->name('user.listAll');
Route::get('/usuarios/novo',                        [UserController::class,     'createUser'])->middleware('auth')->name('user.create');
Route::post('/usuarios/store',                      [UserController::class,     'store'])->middleware('auth')->name('user.store');
// ---   Visualizar registro   ---
Route::get('/usuarios/{user}',                      [UserController::class,     'show'])->middleware('auth')->name('user.listUser');
Route::get('/usuarios/edit/{user}',                 [UserController::class,     'edit'])->middleware('auth')->name('user.edit');
Route::put('/usuarios/atualizar/{user}',            [UserController::class,     'update'])->middleware('auth')->name('user.update');
Route::delete('/usuarios-delete/{id}',              [UserController::class,     'excluir'])->middleware('auth')->name('user.delete');
// -------------------------------------Perguntas----------------------------------------------------------------------------------------
Route::get('/perguntas',                            [QuestionController::class, 'index'])->Middleware('auth')->name('perguntas.index');
Route::get('/perguntas-listagem',                   [QuestionController::class, 'buscaDados'])->Middleware('auth')->name('perguntas.listagem');
Route::get('/pergunta/novo',                        [QuestionController::class, 'create'])->middleware('auth')->name('perguntas.create');
Route::post('/pergunta/store',                      [QuestionController::class, 'store'])->middleware('auth')->name('perguntas.store');
Route::get('/perguntas/edit/{id}',                  [QuestionController::class, 'edit'])->middleware('auth')->name('perguntas.edit');
Route::put('/perguntas/atualizar/{id}',             [QuestionController::class, 'update'])->Middleware('auth')->name('perguntas.update');
Route::get('/pergunta/{pergunta}',                  [QuestionController::class, 'show'])->middleware('auth')->name('pergunta.listar');
Route::delete('/perguntas-delete/{id}',             [QuestionController::class, 'excluir'])->middleware('auth')->name('pergunta.delete');
// -------------------------------------Opções Perguntas---------------------------------------------------------------------------------
Route::resource('/options',                      OptionController::class)->except('show')->middleware('auth');
//   --------------------------------------Pesquisa---------------------------------------------------------------------------------------
Route::get('/respostas',                            [AnswerController::class, 'index'])->middleware('auth')->name('respostas.index');
Route::get('/respostas-listagem',                   [AnswerController::class, 'getResponse'])->middleware('auth')->name('respostas.getResponse');

Route::get('/resposta/show/{id}',                  [AnswerController::class, 'show'])->name('resposta/show');
Route::get('/respostamostrar',                     [AnswerController::class, 'mostrarResposta']);

//  --- Acesso público a pesquisa ---   //
Route::get('principal',                            [QuestionController::class, 'pesquisa'])->name('pesquisa');

// Questões da pesquisa
Route::any('answer', function () {
    return view('site.answer');
});

// Inicia a pesquisa
Route::any('start', function () {
    return view('site.start');
});

// Finaliza a pesquisa
Route::any('end', function () {
    return view('site.end');
});

Route::any('submitans',                             [QuestionController::class, 'submitans']);
Route::any('startquiz',                             [QuestionController::class, 'startquiz'])->name('startquiz');
//  Rotas com joins para teste  //
Route::get('/join1',                                  [PesquisaController::class, 'join']);
Route::get('/join2',                                  [PesquisaController::class, 'joinWithGroupBy']);
