<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\profiles\reviewer\StorereviewerRequest;
use App\Http\Requests\profiles\reviewer\UpdatereviewerRequest;
use App\Http\Resources\ReviewerResource;
use App\Models\Reviewer;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReviewerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $reviewer = Reviewer::with(['user'])->get();
        return ReviewerResource::collection($reviewer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorereviewerRequest  $request)
    {
 
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'picture' => $request->picture,
        ]);
 
        $reviewer = $user->reviewer()->create([

            'birth_date' => $request->birth_date
        ]);
    
        return response()->json([
            'status' => true,
            'reviewer' => new ReviewerResource($reviewer),
            'message' => 'Reviewer registered successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ], 201);
    } 

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $reviewer = Reviewer::findOrFail($id);
        return new ReviewerResource($reviewer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatereviewerRequest $request, $id)
    {
        $reviewer = Reviewer::findOrFail($id);
        $user = $reviewer->user;
    
        if ($request->user()->id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $reviewer->update($request->validated());
        $user->update($request->validated());
    
        return new ReviewerResource($reviewer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $reviewer = Reviewer::findOrFail($id);
        $user = $reviewer->user;
    
        if ($request->user()->id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $reviewer->delete();
        $user->delete();
    
        return response()->noContent();
    }
}
