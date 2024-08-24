<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Http\Requests\follows\StorefollowRequest;
use App\Http\Requests\follows\UpdatefollowRequest;
use App\Http\Resources\FollowResource;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $follow = Follow::with(['reviewer'])->get();
        return FollowResource::collection($follow);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefollowRequest $request)
    {

        $reviewer = $request->user()->reviewer;
        $follow = $reviewer->follow()->create($request->validated());
    
        return new FollowResource($follow);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $follow = Follow::findOrFail($id);
        return new FollowResource($follow);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefollowRequest $request, follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {

        $follow = Follow::with('reviewer')->findOrFail($id);
        $reviewer = $follow->reviewer;
        $deleter = $request->user()->reviewer->id;
        
        if ($deleter !== $reviewer->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $follow->delete();
     
        return response()->noContent();
    }
}
