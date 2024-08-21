<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use App\Http\Requests\profiles\publisher\StorepublisherRequest;
use App\Http\Requests\profiles\publisher\UpdatepublisherRequest;
use App\Http\Resources\PublisherResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $publisher = Publisher::with(['user'])->get();
        return PublisherResource::collection($publisher);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepublisherRequest  $request)
    {
 
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'picture' => $request->picture,
        ]);
 
        $publisher = $user->publisher()->create([

            'address' => $request->address
        ]);
    
        return response()->json([
            'status' => true,
            'publisher' => new PublisherResource($publisher),
            'message' => 'Publisher registered successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ], 201);
    } 

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $publisher = Publisher::findOrFail($id);
        return new PublisherResource($publisher);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepublisherRequest $request, $id)
    {
        $publisher = Publisher::findOrFail($id);
        $user = $publisher->user;
    
        if ($request->user()->id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $publisher->update($request->validated());
        $user->update($request->validated());
    
        return new PublisherResource($publisher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $publisher = Publisher::findOrFail($id);
        $user = $publisher->user;
    
        if ($request->user()->id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $publisher->delete();
        $user->delete();
    
        return response()->noContent();
    }
}

