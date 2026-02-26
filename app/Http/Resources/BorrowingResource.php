<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "book"=> $this->book(),
            "member"=> $this->member(),
            "borrowed_date"=> $this->borrowed_date,
            "due_date"=>$this->due_date,
            "status"=>$this->status
        ];
    }
}
