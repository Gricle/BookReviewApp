<?php

namespace App\Http\Requests\comments;

use App\Enum\CommentableTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateCommentRequest extends FormRequest
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
            'commentable_type' => [new Enum(CommentableTypeEnum::class)],
            'message' => 'required|string|max:1000|min:3',
            'reply_id' => 'nullable|integer',
        ];
    }
}
