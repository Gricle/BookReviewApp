<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Http\Requests\rating\StoreratingRequest;
use App\Http\Requests\rating\UpdateratingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Book;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rating = Rating::all();
        return RatingResource::collection($rating);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreratingRequest $request)
    {
        $reviewer = $request->user()->reviewer;
        $rate = $reviewer->rating()->create($request->validated());
    
        return new RatingResource($rate);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $rating = Rating::findOrFail($id);
        return new RatingResource($rating);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateratingRequest $request, $id)
    {

        $rating = Rating::findOrFail($id);

        $reviewer = $rating->reviewer; 

        $updater = $request->user()->reviewer->id ;

        if ($updater !== $reviewer->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $rating->update($request->validated());
    
        return new RatingResource($rating);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {

        $rating = Rating::with('reviewer')->findOrFail($id);
        $reviewer = $rating->reviewer;
        $deleter = $request->user()->reviewer->id;
        
        if ($deleter !== $reviewer->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $rating->delete();
     
        return response()->noContent(); 
    }

    public function getAverage($id)
    {
        $book = Book::with('rating')->findOrFail($id);
    
        if ($book->rating->isEmpty()) {
            return 0; 
        }

        $averageRating = $book->rating->avg('score');
    
        return $averageRating;
    }
}