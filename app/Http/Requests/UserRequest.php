<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $email = $this->id != null ? ['required', 'unique:users,email,' .  $this->id] :  ['required', 'unique:users']; 
        return [
            'name' => 'required|max:255',
            'email' => $email,
            'avater' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
