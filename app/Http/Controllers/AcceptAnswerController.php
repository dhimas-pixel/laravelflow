<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Answer $answer, Request $request)
    {
        $answer->question->acceptAnswer($answer);

        return back()->with('success', 'The answer was accepted.');
    }
}
