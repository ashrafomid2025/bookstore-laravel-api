<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookInsertionRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $books =  Book::with('author')->paginate(10);
       return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookInsertionRequest $request)
    {
      $book =   Book::create($request->validated());
       $book->load("author");
       return new BookResource($book);
      }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
