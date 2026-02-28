<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingInsertRequest;
use App\Http\Resources\BorrowingResource;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class borrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $borrowings = Borrowing::with(['book', 'member'])->paginate(10);
        return BorrowingResource::collection($borrowings);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BorrowingInsertRequest $request)
    {
        //
        
      $borrow =  Borrowing::create($request->validated());
      $borrow->load(['book','member']);
      return new BorrowingResource($borrow);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->load(['book','member']);
        return new BorrowingResource($borrowing);

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
