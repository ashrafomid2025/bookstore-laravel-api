<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberInsertRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Exception;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try{
       $command =  Member::with('activeBorrowing');
    //    localhost:8000/member?search=b
    // $con->query("slect")
       if($request->has('search')){
        $search =  $request->search;
       $command->where(function($q) use($search){
             $q->where('name','like',"%{$search}%")
            ->orWhere('email','like',"%{$search}%")
            ->orWhereHas('activeBorrowing',function($bookQuery) use ($search){
                 $bookQuery->where("title","like","%{$search}%");
            });
        
       });
       }
       $members = $command->paginate(10);
       return MemberResource::collection($members);
        }
        catch(Exception $eror){
            return response()->json([
                "error"=> $eror->getMessage()
            ]);
        }
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
    public function show(String $id)
    {
        try{
     $member =  Member::findOrFail($id);
        return new MemberResource($member);
        }
        catch(\Exception $error){
            return response()->json(
            [
                "message"=> "Use with the id ". $id . " is not found, please try again"
            ],
            405
            );
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    //     //

       $member =   Member::findOrFail($id);
       $member->update($request->validated()) ;
       return new MemberResource($member);  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{

        $member =  Member::findOrFail($id);
        $member->delete();
    
        return response()->json([
            "message"=> "Member with Id ". $member->id ." has been deleted successfully"
        ],202);
        }catch(Exception $error){
            return response()->json([
                "error"=> $error->getMessage(),
            ],404);
        }
    }
}
