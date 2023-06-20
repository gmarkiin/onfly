<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class RegisterRequest extends BaseRequestForm
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|string|max:255',
            'password' => 'required|string',
        ];
    }
}
