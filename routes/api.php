<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\borrowingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberControllerV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// laravel=> python
// 

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('author', AuthorController::class);
    Route::apiResource('book', BookController::class);
    Route::post("logout",[AuthController::class, 'logout']);

    Route::apiResource('borrow',borrowingController::class)->only('index','store','show');    
    Route::apiResource('member', MemberController::class);
Route::post('borrowings/{borrowing}/return',[borrowingController::class,'returnBook']); 
Route::get('borrowings/overdue/list',[borrowingController::class,'overdue']);







    });
    
    // author route is now protected
    // Books
    // Memeber
    

// authentication routes
Route::post('register', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);