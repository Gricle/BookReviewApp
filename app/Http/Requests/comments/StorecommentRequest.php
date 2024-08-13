<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorecommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string|in:Books,Publisher',
            'message' => 'required|string|max:1000|min:3',
            'reply_id' => 'nullable|integer',
        ];
    }
}
