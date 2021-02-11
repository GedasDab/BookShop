<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//book
Route::resource('/book', App\Http\Controllers\BookController::class);
//Gets books by id
Route::get('/book/myBooks/{id}', [App\Http\Controllers\BookController::class, 'getAllUserBooks'])->name('userBook');
Route::post('/review/store/{book_id}/{user_id}', [App\Http\Controllers\ReviewController::class, 'store' ])->name('review.store');
Route::post('/review/index/{book_id}', [App\Http\Controllers\ReviewController::class, 'index' ])->name('review.index');
Route::get('/', function(){
    return redirect()->route('book.index');
});
