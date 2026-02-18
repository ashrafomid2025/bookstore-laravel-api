<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookInsertionRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Exception;
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
    public function show(Book $book)
    {
        //
         $book->load("author");
        return new BookResource($book);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
       $book->update($request->validated());
       $book->load('author');
       return new BookResource($book);
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
