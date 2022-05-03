<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\AutoCompleteController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CsvUploadController;
use App\Http\Controllers\ItemController;


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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes([
    'register'=>false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('categories', CategoryController::class)->middleware('auth');
//Route::resource('categories', CategoryController::class)->only(['index','show']);

Route::resource('publishers', PublisherController::class)->middleware('auth');
//Route::resource('publishers', PublisherController::class)->only(['index','show']);

Route::resource('authors', AuthorController::class)->middleware('auth');
//Route::resource('authors', AuthorController::class)->only(['index','show']);

Route::resource('donators', DonatorController::class)->middleware('auth');
//Route::resource('donators', DonatorController::class)->only(['index','show']);

Route::resource('books', BookController::class)->middleware('auth');
//Route::resource('books', BookController::class)->only(['index','show']);

Route::resource('items', ItemController::class)->middleware('auth');
//Route::resource('items', ItemController::class)->only(['index','show']);

Route::resource('borrowings', BorrowingController::class)->middleware('auth');
//Route::resource('borrowings', BorrowingController::class)->only(['index','show']);

Route::resource('readers', ReaderController::class)->middleware('auth');
//Route::resource('readers', ReaderController::class)->only(['index','show']);

Route::get('/autocomplete-search',[AutoCompleteController::class, 'searchFor']);


Route::get('/csvupload',[CsvUploadController::class,'index'])->middleware('auth');
Route::post('/csvupload',[CsvUploadController::class,'uploadCsv'])->middleware('auth');




