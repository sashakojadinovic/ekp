<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Book;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //dd($request->id);
        $book = Book::find($request->id);
        //$category = Category::find($request->cat);
        $category = $book->categories()->first();
        $locations = Location::all();
/*         $num_of_items_in_cat = 0;
        foreach ($category->books()->get() as $b) {
            $num_of_items_in_cat += count($b->items()->get());
        } */
        return view('item.item-create', ['book' => $book, 'signature' => $category->prefix . ($category->counter+1),'locations'=>$locations]);
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
        $item = new Item;
        $locations = Location::all();
        $content = $request->validate([
            'signature' => 'required',
            'donator_array' => 'present',
            'available' => 'present',
            'book_id' => 'required | integer',
            'location'=>'required | integer'
        ]);
        $item->signature = $content['signature'];
        $item->available = $content['available'];
        $item->donator()->associate($content['donator_array']);
        $item->book()->associate($content['book_id']);
        $item->location()->associate($content['location']);
        $item->save();
        $category = $item->book()->first()->categories()->first();
        $category->counter= $category->counter+1;
        $category->save();
        $book = Book::find($content['book_id']);
        //dd($book);
        /* $next_num_of_books_in_cat = count(Category::find($book->categories()->first())->books()->get())+1;
        $category_short = strtoupper(substr(Category::find($book->categories()->first()->id)->name,0,2)); */
        //return view('item.item-create', ['book'=>$book,'signature'=>$category_short.$next_num_of_books_in_cat]);
        return view('item.item-create', ['book' => $book,'signature' => $category->prefix . ($category->counter+1),'locations'=>$locations]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $locations = Location::all();
        return view('item.item-edit',['item'=>$item,'locations'=>$locations]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $content = $request->validate([
            'signature' => 'required',
            'donator_array' => 'present',
            'available' => 'present',
            'location'=>'required | integer'
        ]);
        //dd($content);
        //$item->location()->disassociate();
        $item->donator()->associate($content['donator_array']);
        $item->location()->associate($content['location']);
        $item->update(['signature'=>$content['signature'],'available'=>$content['available']]);


        return redirect("/books/".$item->book()->first()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
