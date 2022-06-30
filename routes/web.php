<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
// Atalho para comentário: ctrl + k + c
Route::get('/', HomeController::class);

Route::get('usuarios/novo',             [UserController::class,     'createUser'])->middleware('auth')->name('user.create');

//Route::get('usuarios', [UserController::class, 'listAllUsers'])->middleware('auth')->name('users.listAll');
// Rota com paginação Ajax - Server Side - em desenvolvimento - 09/05/2022
//Route::get('usuarios.ajax', [UserController::class, 'listAllAjax'])->name('users.datatablelist');

// Paginação Ajax - 27/06/22
Route::get('/users',                    [UserController::class,     'indexList']);

Route::get('/users-getData',            [UserController::class,     'getData']);

//Route::get('usuarios',                  [UserController::class,      'index']);

//Route::get('usuarios/ajax',             [UserController::class,      'listaUsuarios']);

Route::post('usuarios/store',           [UserController::class,     'store'])->middleware('auth')->name('user.store');

Route::get('usuarios/{user}',           [UserController::class,     'listUser'])->middleware('auth')->name('user.listUser');

Route::get('usuarios/{user}/edit',      [UserController::class,     'edit'])->middleware('auth')->name('user.edit');

Route::put('usuarios/{user}/atualizar', [UserController::class,     'update'])->middleware('auth')->name('user.update');

Route::get('usuarios/{user}/excluir',   [UserController::class,     'excluir'])->middleware('auth')->name('user.delete');
// Chama a view de cadastro de perguntas
Route::get('questions/novo',            [QuestionController::class, 'createQuestion'])->name('question.create');
// Mostrar perguntas usuário
Route::get('questions/{id}',            [UserController::class,     'show']);
// Cadastrar perguntas
Route::post('questions/store',          [QuestionController::class, 'store'])->name('question.store');

require __DIR__ . '/auth.php';
