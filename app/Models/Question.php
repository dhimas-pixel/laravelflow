<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function booted(): void
    {
        static::creating(function (Question $question) {
            $question->slug = str($question->title)->slug();
        });
    }


    public function scopeMine(Builder $query)
    {
        if (!Auth::check()) {
            return;
        }

        $query->whereBelongsTo(auth()->user());
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function acceptAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function bookmarkedBy(?User $user)
    {
        if ($user) {
            return $this->bookmarks()->where('user_id', $user->id)->exists();
        }
        return false;
    }

    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }
}
