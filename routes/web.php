<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',                                     HomeController::class);
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
Route::get('/perguntas',                            [QuestionController::class, 'indexPerguntas'])->Middleware('auth')->name('perguntas.index');
Route::get('/perguntas-listagem',                   [QuestionController::class, 'buscaDados'])->Middleware('auth')->name('perguntas.listagem');

Route::get('/pergunta/novo',                        [QuestionController::class, 'create'])->middleware('auth')->name('perguntas.create');
Route::post('/pergunta/store',                      [QuestionController::class, 'store'])->middleware('auth')->name('perguntas.store');

Route::get('/perguntas/edit/{id}',                  [QuestionController::class, 'edit'])->middleware('auth')->name('perguntas.edit');
Route::put('/perguntas/atualizar/{id}',             [QuestionController::class, 'update'])->name('perguntas.update');

Route::get('/pergunta/{pergunta}',                  [QuestionController::class, 'show'])->middleware('auth')->middleware('auth')->name('pergunta.listar');

Route::delete('/perguntas-delete/{id}',             [QuestionController::class, 'excluir'])->middleware('auth')->name('pergunta.delete');

require __DIR__ . '/auth.php';
