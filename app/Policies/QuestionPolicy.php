<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;

class QuestionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }

    public function delete(User $user, Question $question): bool
    {
        return $user->id === $question->user_id && $question->answers()->count() < 1;
    }
}
