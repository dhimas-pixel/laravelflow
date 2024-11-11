<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QuestionController::class, 'index'])->name('questions.index');

Route::get('/questions/{question:slug}', [QuestionController::class, 'show'])->name('questions.show');
