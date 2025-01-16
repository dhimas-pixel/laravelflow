<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function avatarUrl()
    {
        $hash = hash('sha256', strtolower(trim($this->email)));

        return 'https://www.gravatar.com/avatar/' . $hash;
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Question::class, 'bookmarks')->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteQuestion(Question $question, int $vote)
    {
        $voteQuestions = $this->voteQuestions();

        if ($voteQuestions->where('votable_id', $question->id)->exists()) {
            $voteQuestions->updateExistingPivot($question, ['vote' => $vote]);
        } else {
            $voteQuestions->attach($question, ['vote' => $vote]);
        }

        $question->load('votes');
        $question->votes_count = $question->votes()->sum('vote');
        $question->save();
    }
}
