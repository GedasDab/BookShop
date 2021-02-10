<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //We will show the index page.
    // admin folder -> index file
    public function index()
    {
        return view('admin.index');
    }

    //Method that creates data
    public function create()
    {
        //
    }

    //Method that stores data
    public function store(Request $request)
    {
        //
    }

    //Method that shows data
    public function show(Admin $admin)
    {
        //
    }

    // Method that edit the data
    public function edit(Admin $admin)
    {
        //
    }

    // Method that updates the data
    public function update(Request $request, Admin $admin)
    {
        //
    }

    // Method that delete the data
    public function delete(Admin $admin)
    {
        //
    }
}
