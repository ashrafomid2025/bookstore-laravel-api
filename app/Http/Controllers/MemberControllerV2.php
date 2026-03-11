<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberInsertRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Exception;
use Illuminate\Http\Request;

class MemberControllerV2 extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        //
    try{
       $command =  Member::with('activeBorrowing');
    
       if($request->has('search')){
        $search =  $request->search;
       $command->where(function($q) use($search){
             $q->where('name','like',"%{$search}%")
            ->orWhere('whatsApp_number','like',"%{$search}%");
       });
       }
       if($request->has('status')){
        $command->where('status',$request->status);
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
        try{

       $member =  Member::create($request->validated());
       return new MemberResource($member); 
        }
        catch(Exception $error){
            return response()->json(
                [
                    "error_message"=> $error->getMessage(),
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        try{
         $member =  Member::with('activeBorrowing')->findOrFail($id);
         return new MemberResource($member);
        }
        catch(Exception $error){
            return response()->json(
            [
                "message"=> "Use with the id ". $id . " is not found, please try again"
            ],
            400
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
        $member->load(['borrowing','activeBorrowing']);
        if($member->activeBorrowing()->count()>0){
            return response()->json(
                ["message"=>"You cannot delete ".$member->name ." bacause he/she borrowed ". $member->activeBorrowing()->count() . " books" ]
            );
        }
        else{
            $member->delete();
            return response()->json(
                ["message"=> $member->name ." has been deleted successfully he can no longer use our facilities"]
            );
        }
       }
       catch(Exception $err){
        return response()->json(
            [
                "error_message"=> $err->getMessage(),
            ]
        );
       }
    }
}
