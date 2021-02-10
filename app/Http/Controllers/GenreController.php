<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        return view('genre.index')
        ->with('genres', Genre::simplepaginate(10));
    }

    // Create method
    public function create()
    {
        return view('genre.create');
    }


    // Store method
    public function store(Request $request)
    {
        // Validation 
        $request->validate([
            'genre' => 'required|min:3|max:255',
        ]);


        Genre::create($request->all());

        // Session response
        return redirect()->route('genre.index')
        ->with('success','Genre created successfully.');
    }

    // Show method
    public function show(Genre $genre)
    {
        //
    }

    // Edit method
    public function edit(Genre $genre)
    {
        return view('genre.edit', compact('genre'));
    }

    // Update method
    public function update(Request $request, Genre $genre)
    {
        // Validation
        $request->validate([
            'genre' => 'required|min:3|max:255',
        ]);

       
        $genre->update($request->all());

        // Success method
        return redirect()->route('genre.index')
        ->with('success','Genre updated successfully.');

    }

    // Delete method
    public function delete(Genre $genre)
    {
        $genre->delete();

        // Returns the success message
        return redirect()->route('genre.index')
        ->with('success','Genre deleted successfully.');
    }
}
