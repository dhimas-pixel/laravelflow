<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = QuestionResource::collection(
            Question::with(['user'])->latest()->paginate(15)
        );

        return inertia('Questions/Index', [
            'questions' => $questions,
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
        $question->update($request->validated());

        return back()->with('success', 'Your question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
