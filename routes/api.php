<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Api\QuestionApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/questions',            [QuestionApiController::class, 'index']);
Route::get('/questions/{question}', [QuestionApiController::class, 'show']);
