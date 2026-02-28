<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookUpdateRequest extends FormRequest
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
            "title"=> "nullable|string|min:7",
            "isbn"=> ["nullable","isbn",
            Rule::unique('books','isbn')->ignore($this->route('book'),'id')
            ],
            "description"=> "nullable|string",
            "published_at"=> "nullable|date",
            "total_copies"=> "nullable|integer|max:80",
            "cover_image"=> "nullable|string",
            "price"=> "nullable|numeric",
            "author_id"=> "nullable|integer|exists:authors,id",
            "genre"=> "nullable|string"
        ];
    }
}
