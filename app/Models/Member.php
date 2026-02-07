<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "whatsApp_number",
        "address",
        "membership_date",
        "status",

    ];
    protected $casts = [
        "membership_date"=>"date"
    ];
    public function borrowing(){
        return $this->belongsTo(Borrowing::class);
    }
    public function activeBorrowing(){
        return $this->borrowing()->where('status','borrowed');
    }
}
