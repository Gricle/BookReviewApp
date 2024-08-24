<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Http\Requests\comments\StoreCommentRequest;
use App\Http\Requests\comments\UpdateCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $comment = Comment::with(['reviewer'])->get();
        return CommentResource::collection($comment);
    }
    /**

 
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $reviewer = $request->user()->reviewer;
        $comment = $reviewer->comment()->create($request->validated());
    
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $comment = Comment::findOrFail($id);
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, $id)
    {

        $comment = Comment::findOrFail($id);

        $reviewer = $comment->reviewer; 

        $updater = $request->user()->reviewer->id ;

        if ($updater !== $reviewer->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $comment->update($request->validated());
    
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {

        $comment = Comment::with('reviewer')->findOrFail($id);
        $reviewer = $comment->reviewer;
        $deleter = $request->user()->reviewer->id;
        
        if ($deleter !== $reviewer->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $comment->delete();
     
        return response()->noContent();
    }
}
