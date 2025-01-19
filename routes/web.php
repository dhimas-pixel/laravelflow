<?php

use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\BookmarkQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteAnswerController;
use App\Http\Controllers\VoteQuestionController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Question\Question;

Route::get('/', [QuestionController::class, 'index'])->name('questions.index');

Route::get('/questions/{question:slug}', [QuestionController::class, 'show'])->name('questions.show');

Route::resource('/questions', QuestionController::class)
    ->except(['index', 'show'])
    ->middleware('auth');
Route::resource('/questions.answers', AnswerController::class)->only(['store', 'destroy', 'update'])->middleware('auth');

Route::post('/questions/answers/{answer}/accept', AcceptAnswerController::class)->name('questions.answers.accept')->middleware('auth');

Route::post('/questions/{question}/bookmark', [BookmarkQuestionController::class, 'store'])->name('questions.bookmark.store')->middleware('auth');
Route::delete('/questions/{question}/bookmark', [BookmarkQuestionController::class, 'destroy'])->name('questions.bookmark.destroy')->middleware('auth');

Route::post('/questions/{question}/vote', VoteQuestionController::class)->name('questions.vote')->middleware('auth');
Route::post('/questions/answers/{answer}/vote', VoteAnswerController::class)->name('questions.answers.vote')->middleware('auth');
