<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class authRequest extends FormRequest
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
            //
             "name"=> "required|string|min:3|max:25",
            "email"=> "required|string|unique:users,email",
            "password"=> "required|string|min:6|confirmed"
        ];
    }
    public function messages()
    {
        return [
            "name|required"=> "the name should be filled",
            "name|min:3"=> "the name filed must be at least 3 characters"
        ];
    }
}
