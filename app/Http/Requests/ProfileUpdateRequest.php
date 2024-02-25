<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(FormRequest $request): array
    {
        $rul = [
            'name' => 'sometimes',
            'email' => 'sometimes',
            'bio' => 'sometimes'
        ];
        if ($request->name) $rel['name'] = 'sometimes|string|min:2|max:255';
        if ($request->email) $rel['email'] = ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)];
        if ($request->bio) $rel['bio'] = 'sometimes|min:3|max:1000';
        
        return $rul;
    }
}
