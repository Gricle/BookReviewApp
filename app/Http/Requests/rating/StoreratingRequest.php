<?php

namespace App\Http\Requests\Rating;

use Illuminate\Foundation\Http\FormRequest;

class StoreratingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; 
    }


    public function rules(): array
    {
        return [
            'score' => 'required|integer|min:1|max:10',
            'rateable_id' => 'required|integer',
            'rateable_type' => 'required|string|in:' . implode(',', [
                \App\Models\Book::class,
                \App\Models\Publisher::class,
            ]),
        ];
    }
}