<?php

namespace App\Http\Requests\profiles\publisher;

use Illuminate\Foundation\Http\FormRequest;

class StorepublisherRequest extends FormRequest
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
            'first_name' => 'required|string|min:3',
            'last_name' => 'nullable|string|min:3',
            'password' => 'required|min:3|max:255',
            'phone' => 'nullable',
            'email' => 'required|email',
            'picture' => 'nullable|string',
            'address' => 'nullable|string|min:3'
        ];
    }
}
