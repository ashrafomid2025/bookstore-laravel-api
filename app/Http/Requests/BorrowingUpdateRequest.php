<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowingUpdateRequest extends FormRequest
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
            "member_id"=> "nullable|integer|exists:members,id",
            "book_id"=> "nullable|integer|exists:books,id",
            "borrowed_date"=>"nullable|date",
            "returned_date"=>"required|date",
            "status"=>"required|string"
        ];
    }
}
