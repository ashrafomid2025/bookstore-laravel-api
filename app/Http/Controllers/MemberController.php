<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberInsertRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $members =  Member::paginate(10);
       return MemberResource::collection($members);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberInsertRequest $request)
    {
        //
       $member =  Member::create($request->validated());
       return new MemberResource($member); 
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
        return response()->json([
            "member"=> $member,
        ]);
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
