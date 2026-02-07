<?php

namespace App\Http\Controllers;

use App\Http\Requests\authorStoreRequest;
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
        $author = Author::all();
        return response()->json([
            "author"=> $author,
        ]);
        // json()
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(authorStoreRequest $request)
    {
        //
        $author = Author::create($request->validated(

        ));
        return response()->json([
            "author"=> $author,
        ],200);
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
