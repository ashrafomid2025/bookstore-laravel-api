<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $fillable = [
        "title",
        "isbn",
        "description",
        "published_at",
        "total_copies",
        "available_copies",
        "genre",
        "price",
        "cover_image",
        "status",
        "author_id"
    ];
    public function author(){
        return $this->belongsTo(Author::class, 'author_id');
    }
    public function borrowing(){
        return $this->hasMany(Borrowing::class);
    }
    public function isAvailable(){
        return $this->available_copies> 0;
    }
    public function borrow(){
        if($this->available_copies> 0){
            $this->decrement('available_copies');
        }
    }
    public function returnBook(){
        if($this->avaiable_copies< $this->total_copies){
            $this->increment('avaiable_copies');
        }
    }
}
