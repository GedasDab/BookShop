<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Gender;
use App\Models\Review;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CreateBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => array('index', 'show') ]);
     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::where('approved', '=', true )->paginate(25);

        return view('main')->with('books', $books);
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.addBook');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {  
        if($request->hasFile('picture'))
        {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('uploads/booksCover/', $filename);
        }else {
            $filename = 'default.png';
        }

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'price' => $request->price,
            'picture' => 'uploads/booksCover/'.$filename,
        ]);

        $authors = explode(',',$request->author);
        $genders = explode(',',$request->gender);

        foreach($authors as $author)
        {
            $authorCheck = Author::where('author','=', $author)->first();
            if ($authorCheck === null)
            {   
                $authorCheck = Author::create(['author'=> $author]);
            }
            $authorCheck->books()->attach($book);
        }
        foreach($genders as $gender)
        {
            $genderCheck = Gender::where('gender','=', $gender)->first();
            if ($genderCheck === null)
            {
                $genderCheck =  Gender::create(['gender'=> $gender]);
            }
            $genderCheck->books()->attach($book);
        }
            return redirect()->route('book.create')->with('message', 'Success');
    }
    public function getAllUserBooks($userId)
    {
        if( auth()->user()->id == $userId)
        {
            $books = Book::where('user_id', '=', $userId )->paginate(15);

            return view('book.manageBook')->with('books', $books);

        }
        return redirect()->route('book.index')->with('message', 'No books!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
            $book->reviews = Review::where('book_id','=',$book->id)->paginate(1);

        return view('book.singleBook')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {

        $authors = $book->authors()->get()->implode('author', ',');
        $genders = $book->genders()->get()->implode('gender', ',');

        $book->authors = $authors;
        $book->genders = $genders;

        return view('book.editUserBook')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBookRequest $request, Book $book)
    {
        if($request->hasFile('picture'))
        {
            if(File::exists(asset( $book->picture))) {
                File::delete(asset( $book->picture));
            }
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('uploads/booksCover/', $filename);

        }

        $authors = explode(',',$request->author);
        $genders = explode(',',$request->gender);      

        $book->authors()->detach();
        $book->genders()->detach();

        foreach($authors as $author)
        {    
            $authorCheck = Author::where('author','=', $author)->first();
            
            if ($authorCheck == null)
            {   
                $authorCheck = Author::create(['author'=> $author]);
            }
            $authorCheck->books()->attach($book);
        }
        foreach($genders as $gender)
        {
            $genderCheck = Gender::where('gender','=', $gender)->first();
            if ($genderCheck == null)
            {
                $genderCheck =  Gender::create(['gender'=> $gender]);
            }
            $genderCheck->books()->attach($book);
        }
      
        $book->title = $request->title;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->picture ='uploads/booksCover/'. $filename; 
        $book->approved = false;
        $book->save();

        return redirect()->route('book.edit', $book->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->authors()->detach();
        $book->genders()->detach();
        $book->delete();

        return redirect()->route('book.show');
    }
}
