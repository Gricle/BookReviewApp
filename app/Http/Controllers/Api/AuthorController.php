<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Http\Requests\profiles\author\StoreauthorRequest;
use App\Http\Requests\profiles\author\UpdateauthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $authors = Author::with(['user'])->get();
        return AuthorResource::collection($authors);
    }
    public function store(StoreauthorRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'picture' => $request->picture,
        ]);
    
        $user->author()->create([

            'nationality' => $request->nationality,
            'birth_date' => $request->birth_date,
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ], 201);
    } 

    public function show($id)
    {
        
        $author = Author::findOrFail($id);
        return new AuthorResource($author);
    }


    /**
     * Update the specified resource in storage.
     */
 public function update(UpdateauthorRequest $request, $id)
{
    $author = Author::findOrFail($id);
    $user = $author->user;

    if ($request->user()->id !== $user->id) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $author->update($request->validated());
    $user->update($request->validated());

    return new AuthorResource($author);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $author = Author::findOrFail($id);
        $user = $author->user;
    
        if ($request->user()->id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $author->delete();
        $user->delete();
    
        return response()->noContent();
    }
}
