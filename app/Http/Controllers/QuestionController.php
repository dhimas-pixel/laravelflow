<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'latest');

        $questions = QuestionResource::collection(
            Question::with(['user'])
                ->withCount('answers')
                ->when($filter === 'mine', function ($query) {
                    $query->mine();
                })
                ->when($filter === 'unanswered', function ($query) {
                    $query->has('answers', '=', 0);
                })
                ->when($filter === 'scored', function ($query) {
                    $query->whereNotNull('best_answer_id');
                })
                ->latest()
                ->paginate(15)
                ->withQueryString()
        );

        return inertia('Questions/Index', [
            'questions' => $questions,
            'filter' => $filter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $request->user()->questions()->create(
            $request->validated()
        );

        return back()->with('success', 'Your question has been submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return inertia('Questions/Show', [
            'question' => QuestionResource::make($question),
            'answers' => AnswerResource::collection(
                $question->answers()->latest()->paginate(5)
            ),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreQuestionRequest $request, Question $question)
    {
        Gate::authorize('update', $question);
        $question->update($request->validated());

        return back()->with('success', 'Your question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        Gate::authorize('delete', $question);
        $question->delete();

        return back()->with('success', 'Your question has been deleted.');
    }
}
