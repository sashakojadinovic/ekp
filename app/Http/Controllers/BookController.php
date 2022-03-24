<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('title')) {
            $books = Book::where('title', 'LIKE', '%' . $request->title . '%')->get();
        } else if ($request->filled('author')) {
            $books = Book::whereHas('authors', function (Builder $query) use($request) {
                $query->where('name', 'LIKE', '%' . $request->author . '%');
            })->get();
        } else if ($request->filled('publisher')) {
            $books = Book::whereHas('publishers', function (Builder $query) use($request) {
                $query->where('name', 'LIKE', '%' . $request->publisher . '%');
            })->get();
        } else {
            $books = Book::paginate(15);
        }

        //$books->appends(['sort'=>'title']);
        return view('book.books', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.book-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $book = new Book;
        $content = $request->validate(
            [
                'title' => 'required',
                'author-array' => 'present',
                //'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
                'category-array' => 'present',
                'year' => 'present',
                'age' => 'present',
                'publisher-array' => 'present',
                'info' => 'present'
            ]
        );
        if ($request->file('image')) {
            $imgName = time() . '.' . $request->file('image')->extension();
            $img = Image::make($request->file('image')->path());
            $img->resize(200, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images' . '/' . $imgName);
            $book->img_url = '/images/' . $imgName;
        }

        $book->title = $content['title'];
        $book->year = $content['year'];
        $book->age = $content['age'];
        $book->info = $content['info'];
        $book->save();
        $book->authors()->attach(explode(",",$content['author-array']));
        $book->categories()->attach($content['category-array']);
        $book->publishers()->attach($content['publisher-array']);

        return redirect()->route('items.create', ['id' => $book->id]);
        //return view('item.item-create',['book'=>$book]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.book', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.book-edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $content = $request->validate(
            [
                'title' => 'required',
                'author-array' => 'present',
                //'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
                'category-array' => 'present',
                'publisher-array' => 'present',
                'info' => 'present'
            ]
        );
        $book->update(['title' => $content['title'], 'info' => $content['info']]);
        $book->save();
        return redirect("/books/$book->id");
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
        $book->categories()->detach();
        $book->publishers()->detach();
        $book->items()->delete();
        $book->delete();
        return redirect('/books');
    }
}
