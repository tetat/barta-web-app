<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|min:2',
            'username' => 'required|min:2|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'bio' => 'sometimes|min:3|max:1000',
            'profile_picture' => 'sometimes|image|mimes:jpg,jpeg,png|max:1024'
        ];
    }
}
