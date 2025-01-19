<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Question $question, Request $request)
    {
        $vote = (int) $request->vote;

        $request->user()->voteQuestion($question, $vote);

        return back()->with('success', 'Your vote for the question has been recorded.');
    }
}
