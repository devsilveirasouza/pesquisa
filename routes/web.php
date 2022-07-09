<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::get('usuarios/novo',             [UserController::class,     'createUser'])->middleware('auth')->name('user.create');
// Chama a view do dataTables
Route::get('/usuarios',                 [UserController::class,     'indexUsuarios'])->Middleware('auth');
// Processamento Server Side com Paginação Ajax
Route::get('/usuarios-listagem',        [UserController::class,     'buscaDados'])->Middleware('auth')->name('user.listAll');

Route::post('usuarios/store',           [UserController::class,     'store'])->middleware('auth')->name('user.store');

Route::get('usuarios/{user}',           [UserController::class,     'listUser'])->middleware('auth')->name('user.listUser');

Route::get('usuarios/{user}/edit',      [UserController::class,     'edit'])->middleware('auth')->name('user.edit');

Route::put('usuarios/{user}/atualizar', [UserController::class,     'update'])->middleware('auth')->name('user.update');

Route::get('usuarios/{user}/excluir',   [UserController::class,     'excluir'])->middleware('auth')->name('user.delete');
// Métodos em desenvovimento
Route::get('pergunta/{id}',             [QuestionController::class, 'show']);

Route::get('/pergunta',                 [QuestionController::class, 'index']);

Route::post('pergunta/cadastrar',        [QuestionController::class, 'cadastrarPergunta'])->name('pergunta.cadastrar');

require __DIR__ . '/auth.php';
