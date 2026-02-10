<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorInsertRequest;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $authors = Author::paginate(10);


         return  AuthorResource::collection($authors);
        // json()
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorInsertRequest $request)
    {
        //
       $author =   Author::create($request->validated());

        return new AuthorResource($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       $author =  Author::findOrFail($id);
        return new AuthorResource($author);
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorInsertRequest $request, string $id)
    {
        //
        $author = Author::findOrFail($id);
        $author->update($request->validated());
        return response()->json([
            "author"=> $author,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
