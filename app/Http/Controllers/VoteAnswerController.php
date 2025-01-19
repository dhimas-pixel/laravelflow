<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Answer $answer, Request $request)
    {
        $vote = (int) $request->vote;

        $request->user()->voteAnswer($answer, $vote);

        return back()->with('success', 'Your vote for the answer has been recorded.');
    }
}
