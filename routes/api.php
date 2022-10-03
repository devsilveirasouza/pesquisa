<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Api\QuestionApiController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/questions',            [QuestionApiController::class, 'index']);
Route::get('/questions/{question}', [QuestionApiController::class, 'show']);

// Pesquisa
Route::get('/questionnaire',        [QuestionApiController::class, 'questionnaire'])->name('questionnaire');

Route::get('/answers',              [QuestionControllerApi::class, 'answer'])->name('answers');
Route::get('/startQuestions',       [QuestionApiController::class, 'startQuestions'])->name('startQuestions');

Route::post('/submitAns',           [QuestionApiController::class, 'submitAns'])->name('submitAns');
