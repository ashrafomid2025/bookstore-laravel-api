<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowingInsertRequest;
use App\Http\Requests\BorrowingUpdateRequest;
use App\Http\Resources\BorrowingResource;
use App\Models\Book;
use App\Models\Borrowing;
use Exception;
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
      $bookid = $borrow->book->id;
      $book =  Book::findOrFail($bookid);
    //   update the validated num of copies to decrease
      $book->update([
        "avaiable_copies"=> $book->avaiable_copies--
      ]);
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
    public function update(BorrowingUpdateRequest $request, string $id)
    {
        //
        try{
           $borrowing =  Borrowing::findOrFail($id);
           $borrowing->update($request->validated());
           return new BorrowingResource($borrowing);
        }
        catch(Exception $err){
            return response()->json([
                "message"=> $err->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
