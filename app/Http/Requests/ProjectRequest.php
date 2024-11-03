<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required',
            'user_id' => 'required',
            'description' => 'nullable',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'staff',
        ];
    }
}
