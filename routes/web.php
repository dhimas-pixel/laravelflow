<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Question\Question;

Route::get('/', [QuestionController::class, 'index'])->name('questions.index');

Route::get('/questions/{question:slug}', [QuestionController::class, 'show'])->name('questions.show');

Route::resource('/questions', QuestionController::class)
    ->except(['index', 'show'])
    ->middleware('auth');
Route::resource('/questions.answers', AnswerController::class)->only(['store', 'destroy', 'update'])->middleware('auth');
