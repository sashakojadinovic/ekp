<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search_term')){
            $authors = Author::where('name','LIKE','%'.$request->search_term.'%')->simplePaginate(50);
        }
        else{
            $authors = Author::orderBy('name')->simplePaginate(50);
        }
        return view('author.authors',['authors'=>$authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.author-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new Author;
        $content = $request->validate([
            'name'=>'required',
            'gender'=>'present',
            'info'=>'present'
        ]);
        $author->name =$content['name'];
        $author->gender=$content['gender'];
        $author->info =$content['info'];
        $author->save();
        return redirect("/authors/$author->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $authors_books = $author->books()->get();
        return view('author.author',['author'=>$author,'authors_books'=>$authors_books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.author-edit',['author'=>$author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $content = $request->validate([
            'name'=>'required',
            'gender'=>'present',
            'info'=>'present'
        ]);
        $author->update(['name'=>$content['name'],'gender'=>$content['gender'],'info'=>$content['info']]);
        return redirect("/authors/$author->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->books()->detach();
        $author->delete();
        return redirect("/authors");
    }
}
