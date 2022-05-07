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

//Route::get('/', function () {
//    return view('home');
////})->middleware('auth');
//Route::get('/', function () {
//    return view('site.home');
//});
Route::redirect("/", "pocetna");
Route::get("/",[\App\Http\Controllers\Site\HomeController::class, "index"])->name("pocetna");
Route::get("/count",[\App\Http\Controllers\Site\HomeController::class, "count"]);
Route::get("/vesti",[\App\Http\Controllers\Site\EventController::class, "index"])->name("vesti");
Route::get("/donatori",[\App\Http\Controllers\Site\FrontController::class, "donors"])->name("donatori");
Route::get("/zajednica",[\App\Http\Controllers\Site\FrontController::class, "community"])->name("zajednica");
//Route::get("/kontakt",[\App\Http\Controllers\Site\FrontController::class, "contact"])->name("kontakt");
Route::get("/prostor",[\App\Http\Controllers\Site\FrontController::class, "prostor"])->name("prostor");
Route::post("/sentMail",[\App\Http\Controllers\Site\FrontController::class, "sentMail"])->name("sentMail");
Route::get("/galerija",[\App\Http\Controllers\Site\GalleryController::class, "index"])->name("galerija");
Route::get("/blog",[\App\Http\Controllers\Site\FrontController::class, "blog"])->name("blog");
Route::get("/blogOne/{id}",[\App\Http\Controllers\Site\FrontController::class, "showBlog"])->name("/blogOne/{id}");



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

Route::resource('projects', \App\Http\Controllers\ProjectController::class)->middleware('auth');
//Route::resource('projects', \App\Http\Controllers\ProjectController::class);

Route::resource('donors', \App\Http\Controllers\DonorController::class)->middleware('auth');
//Route::resource('donors', \App\Http\Controllers\DonorController::class);

Route::resource('events', \App\Http\Controllers\EventController::class)->middleware('auth');
//Route::resource('events', \App\Http\Controllers\EventController::class);

Route::resource('blogs', \App\Http\Controllers\BlogController::class)->middleware('auth');
//Route::resource('blogs', \App\Http\Controllers\BlogController::class);

Route::post('/addTag', [\App\Http\Controllers\BlogController::class, "addTag"])->name("addTag")->middleware('auth');
//Route::post('/addTag', [\App\Http\Controllers\BlogController::class, "addTag"])->name("addTag");


Route::get('/photos/{id}',[\App\Http\Controllers\EventController::class, 'photos'])->name("photos")->middleware('auth');
//Route::get('/photosShow/{id}',[\App\Http\Controllers\EventController::class, 'photosShow'])->name("photosShow");

Route::get('/photos/{id}',[\App\Http\Controllers\EventController::class, 'photos'])->name("photos")->middleware('auth');
//Route::post('/photos/{id}',[\App\Http\Controllers\EventController::class, 'photos'])->name("photos");



Route::get('/main/{id}',[\App\Http\Controllers\EventController::class, 'main'])->name("main")->middleware('auth');
//Route::get('/main/{id}',[\App\Http\Controllers\EventController::class, 'main'])->name("main");

Route::get('/autocomplete-search',[AutoCompleteController::class, 'searchFor']);


Route::get('/csvupload',[CsvUploadController::class,'index'])->middleware('auth');
Route::post('/csvupload',[CsvUploadController::class,'uploadCsv'])->middleware('auth');




