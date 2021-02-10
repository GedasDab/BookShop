<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookShop;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display method
    public function index()
    {
        return view('book.index')
        ->with('books', 
        Book::orderBy('created_at', 'desc')
        ->simplepaginate(10));
    }

    // Create method
    public function create()
    {
        //
    }

    // Store method
    public function store(Request $request)
    {
        //
    }

    // Show method
    public function show(BookShop $bookShop)
    {
        //
    }

    // Edit method
    public function edit(BookShop $bookShop)
    {
        //
    }

    // Update method
    public function update(Request $request, BookShop $bookShop)
    {
        //
    }

    // Delete method
    public function delete(BookShop $bookShop)
    {
        //
    }
}
