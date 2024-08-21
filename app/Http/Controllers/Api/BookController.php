<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Http\Requests\books\StoreBookRequest;
use App\Http\Requests\books\UpdateBookRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $books = Book::with(['publisher'])->get();
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $publisher = $request->user()->publisher;
        $book = $publisher->book()->create($request->validated());
    
        return response()->json([
            'message' => 'Book created successfully!',
            'book' => new BookResource($book)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $books = Book::findOrFail($id);
        return new BookResource($books);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateBookRequest $request, $id)
    {

        $book = Book::findOrFail($id);

        $publisher = $book->publisher; 

        $updater = $request->user()->publisher->id ;

        if ($updater !== $publisher->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $book->update($request->validated());
    
        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {

        $book = Book::with('publisher')->findOrFail($id);
        $publisher = $book->publisher;
        $deleter = $request->user()->publisher->id;
        
        if ($deleter !== $publisher->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $book->delete();
     
        return response()->noContent();
    }
}
