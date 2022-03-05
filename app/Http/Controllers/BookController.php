<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('book.books',['books'=>$books]);
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
                    'author-array'=>'present',
                    //'donator-array'=>'present',
                    'category-array'=>'present',
                    'publisher-array'=>'present',
                    'info' => 'present'
                ]
            );
            $book->title=$content['title'];
            $book->info=$content['info'];
 /*            if($content['authors']){
            $book->authors()->attach(explode(",",$content['authors'])); //u attach ide parametar author_id, može i niz
        } */
/*             if($content['donator-array']){
                $book->donator()->associate($content['donator-array']);
            } */
            $book->save();
            $book->authors()->attach($content['author-array']);
            $book->categories()->attach($content['category-array']);
            $book->publishers()->attach($content['publisher-array']);

            return redirect()->route('items.create',['id'=>$book->id]);
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
        return view('book.book',['book'=>$book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.book-edit',['book'=>$book]);
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
                'donator'=>'present',
                'info' => 'present'
            ]
        );
        $book->update(['title'=>$content['title'],'info'=>$content['info']]);
        if($content['donator']){
            $book->donator()->associate($content['donator']);
        }
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
        return redirect ('/books');
    }
}
