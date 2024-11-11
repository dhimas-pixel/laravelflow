<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Questions/Index', [
        'questions' => [
            [
                'id' => 1,
                'title' => 'Question 1',
            ],
            [
                'id' => 2,
                'title' => 'Question 2',
            ],
        ],
    ]);
})->name('questions.index');

Route::get('/questions/{id}', function ($id) {
    return inertia('Questions/Show', [
        'question' => [
            'id' => $id,
            'title' => 'Question ' . $id,
        ],
    ]);
})->name('questions.show');
