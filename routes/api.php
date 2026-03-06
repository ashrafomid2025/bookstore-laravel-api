<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\borrowingController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('author', AuthorController::class);

// Books
Route::apiResource('book', BookController::class);
// Memeber
Route::apiResource('member', MemberController::class);

// authetication, 
Route::post("register",[AuthController::class,'register']);
Route::apiResource('borrow',borrowingController::class)->only('index','store','show');

Route::post('borrowings/{borrowing}/return',[borrowingController::class,'returnBook']); 
Route::get('borrowings/overdue/list',[borrowingController::class,'overdue']);