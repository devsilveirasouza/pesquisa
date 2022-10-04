<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\QuestionApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/questions/{question}', [QuestionApiController::class, 'show']);
});
// Public routes
Route::get('/questions',            [QuestionApiController::class, 'index']);
Route::get('/questionnaire',        [QuestionApiController::class, 'questionnaire'])->name('questionnaire');
Route::get('/answers',              [QuestionApiController::class, 'answer'])->name('answers');
Route::get('/startQuestions',       [QuestionApiController::class, 'startQuestions'])->name('startQuestions');
Route::get('/endQuestions',         [QuestionApiController::class, 'endQuestions'])->name('endQuestions');
Route::post('/submitAns',           [QuestionApiController::class, 'submitAns'])->name('submitAns');
