<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::paginate();
        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $author = Author::create($validated);
        return response()->json($author, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $author = Author::findOrFail($id);
        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $author = Author::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'string|max:100',
            'bio' => 'nullable|string',
            'status' => 'in:active,inactive'
        ]);

        $author->update($validated);
        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        
        $author = Author::findOrFail($id);
        $author->delete();
        return response()->json(null, 204);
    }
}
