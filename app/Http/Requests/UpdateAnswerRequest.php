<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateAnswerRequest extends StoreAnswerRequest
{
    public function authorize(): bool
    {
        return Gate::allows('update', $this->route('answer'));
    }
}
