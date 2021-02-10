<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use Illuminate\Http\Request;

class BookShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    // Index method.
    public function index()
    {
        return view('book')
        ->with('books', 
        Book::where('check', NULL)
        ->orderBy('created_at', 'desc')
        ->simplepaginate(25));
    }

    // Create method
    public function create()
    {
            return view('book_create')
            ->with('genres', Genre::all());
    }

    // Add method.
    public function store(Request $request)
    {
         //Validation
        $request->validate([
            'title' => 'required|min:5',
            'author' => 'required|min:10',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'genre' => 'required|array',
            'description' => 'required|min:20',
        ]);

        $imageName = time().'.'.$request->cover->extension();  
        $request->cover->storeAs('public', $imageName);

        $requestData = $request->all();

        $requestData['cover'] = $imageName;
        $requestData['user_id'] = Auth::id();
        $requestData['check'] = "0";

        $authors = explode(",", $request->author);

        //var_dump($authors);

        $book_id = Book::create($requestData);
        // We give the genre.
        $book_id->genres()->sync($request->genre);

        //Save the author.
        foreach($authors as $author){
            $author_data = Author::updateOrCreate(['name' => $author]);

            $author_id[] = $author_data->id;
        }

        $book_id->authors()->sync($author_id);

        // Returns with the message.
        return redirect()->route('index')
        ->with('success','Book created successfully.');
    }

    // Show method
    public function show(Book $book)
    {
        //
    }

    // Edit method
    public function edit(Book $book)
    {
        //
    }

    // Update method
    public function update(Request $request, Book $book)
    {
        //
    }

    //Delete method
    public function delete(Book $book)
    {
        //
    }
}
