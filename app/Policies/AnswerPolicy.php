<?php

namespace App\Policies;

use App\Models\User;

class AnswerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, $answer): bool
    {
        return $user->id === $answer->user_id;
    }

    public function delete(User $user, $answer): bool
    {
        return $user->id === $answer->user_id;
    }

    public function accept(User $user, $answer): bool
    {
        return $user->id === $answer->question->user_id;
    }
}
