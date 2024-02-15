<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (session('username') !== null) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $Rules = [
            'description' => 'required|min:2|max:1000',
            'image.*' => 'required|image|mimes:jpeg,jpg,png|max:1024'
        ];
        if ($this->image === null) {
            unset($Rules['image.*']);
        }

        return $Rules;
    }
}
