<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)
            ->has(
                Question::factory(5)->has(
                    Answer::factory(15)->state(function (array $attributes, Question $question) {
                        return [
                            'user_id' => $question->user_id
                        ];
                    })
                )
            )
            ->create();
    }
}
