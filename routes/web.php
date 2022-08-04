<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',                         HomeController::class);
// -------------------------------------Usuarios-----------------------------------------------------------------------------------------
Route::get('/usuarios',                             [UserController::class,     'indexUsuarios'])->Middleware('auth')->name('user.list');
Route::get('/usuarios-listagem',                    [UserController::class,     'buscaDados'])->Middleware('auth')->name('user.listAll');

Route::get('/usuarios/novo',                        [UserController::class,     'createUser'])->middleware('auth')->name('user.create');
Route::post('/usuarios/store',                      [UserController::class,     'store'])->middleware('auth')->name('user.store');

Route::get('/usuarios/{user}',                      [UserController::class,     'show'])->middleware('auth')->name('user.listUser');

Route::get('/usuarios/{user}/edit',                 [UserController::class,     'edit'])->middleware('auth')->name('user.edit');
Route::put('/usuarios/{user}/atualizar',            [UserController::class,     'update'])->middleware('auth')->name('user.update');

Route::delete('/usuarios/{user}/excluir',           [UserController::class,     'excluir'])->middleware('auth')->name('user.delete');
// -------------------------------------Perguntas----------------------------------------------------------------------------------------
Route::get('/perguntas',                            [QuestionController::class, 'index'])->Middleware('auth')->name('perguntas.index');
Route::get('/perguntas-listagem',                   [QuestionController::class, 'listagem'])->Middleware('auth')->name('perguntas.listagem');
Route::get('/perguntas-ajax',                       [QuestionController::class, 'getQuestion'])->middleware('auth')->name('perguntas.listAjax');
Route::get('/pergunta/novo',                        [QuestionController::class, 'create'])->middleware('auth')->name('pergunta.criar');
Route::post('/pergunta/store',                      [QuestionController::class, 'cadastrarPergunta'])->middleware('auth')->name('pergunta.cadastrar');
Route::get('/pergunta/{pergunta}/edit',             [QuestionController::class, 'edit'])->middleware('auth')->name('pergunta.edit');
Route::put('/pergunta/{pergunta}/atualizar',        [QuestionController::class, 'update'])->name('pergunta.update');
Route::get('/pergunta/{pergunta}',                  [QuestionController::class, 'show'])->middleware('auth')->middleware('auth')->name('pergunta.listar');
Route::get('/pergunta/{question}/excluir',          [QuestionController::class, 'excluir'])->middleware('auth')->name('pergunta.delete');

require __DIR__ . '/auth.php';
