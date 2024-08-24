<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class usersUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'password' => 'required',
            'phone' => 'nullable',
            'email' => 'required|email',
            'picture' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ];
    }
}
