<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Item;
use App\Models\Category;
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
        //dd($request->filled('seach_term'));
        if ($request->search_term !== "" && $request->criteria === "title") {

            $books = Book::where($request->criteria, 'LIKE', '%' . $request->search_term . '%')->get();
        } else if ($request->search_term !== "" && $request->criteria === "author") {

            $books = Book::whereHas('authors', function (Builder $query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search_term . '%');
            })->get();
        } else if ($request->search_term !== "" && $request->criteria === "publisher") {
            $books = Book::whereHas('publishers', function (Builder $query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search_term . '%');
            })->get();
        }
        else if ($request->search_term !== "" && $request->criteria === "signature") {
            $signature = Item::where($request->criteria, '=', $request->search_term )->first();
            //dd($signature);

            $books = $signature?$signature->book()->get():[];


        }
        else {

            //$books = Book::simplePaginate(20)->sortByDesc('created_at');
            $books = Book::orderByDesc('created_at')->simplePaginate(20);
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
        return view('book.book-create',['categories'=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function saveImage($file, $book, $update)
    { //proveri ovde da li postoji bolji način umesto prosleđivanja $book kao parametar

        if ($update && file_exists($book->img_url)) {
            unlink($book->img_url);
        }
        if (!$file) {
            return;
        }
        $imgName = time() . '.' . $file->extension();
        $img = Image::make($file->path());
        $img->resize(200, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save('images' . '/' . $imgName);
        $book->img_url = 'images/' . $imgName;
    }
    public function store(Request $request)
    {
        //dd($request);
        $book = new Book;
        $content = $request->validate(
            [
                'title' => 'required',
                'author-array' => 'present',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'category-array' => 'required',
                'year' => 'present',
                'age' => 'present',
                'publisher-array' => 'present',
                'info' => 'present'
            ]
        );
        //dd($content);
        $this->saveImage($request->file('image'), $book, false);


        $book->title = $content['title'];
        $book->year = $content['year'];
        $book->age = $content['age'];
        $book->info = $content['info'];
        $book->save();
        if($content['author-array']){
            $book->authors()->attach(explode(",", $content['author-array']));
        }

        $book->categories()->attach($content['category-array']);
        if($content['publisher-array']){
            $book->publishers()->attach($content['publisher-array']);
        }


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
        $items = $book->items()->get()->all();
        $borrowings =[];
        foreach($items as $item){
            $borrs = $item->borrowing()->withTrashed()->get()->sortByDesc('created_at');
            if(count($borrs)>0){
                foreach($borrs as $borr){
                    array_push($borrowings,$borr);
                }

            }

        }
        //dd($borrowings);
        return view('book.book', ['book' => $book,'borrowings'=>$borrowings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.book-edit', ['book' => $book,'categories'=>Category::all()]);
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
        //dd($request);
        $content = $request->validate(
            [
                'title' => 'required',
                'author-array' => 'present',
                //'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
                'category-array' => 'present',
                'year' => 'present',
                'age' => 'nullable|integer',
                'publisher-array' => 'present',


                'info' => 'present'
            ]
        );
        //dd($request);
        if ($request->file('image')) {
            $this->saveImage($request->file('image'), $book, true);
        }

        $book->update(['title' => $content['title'], 'year' => $content['year'], 'age' => $content['age'], 'info' => $content['info']]);
        $book->authors()->detach();
        if ($content['author-array']) {
            $book->authors()->attach(explode(",", $content['author-array']));
        }


        $book->categories()->detach();
        $book->categories()->attach(explode(",", $content['category-array']));
        $book->publishers()->detach();
        if ($content['publisher-array']) {
            $book->publishers()->attach(explode(",", $content['publisher-array']));
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
        if ($book->img_url && $book->img_url !== "images/default.png") {
            unlink($book->img_url);
        }
        $book->authors()->detach();
        $book->categories()->detach();
        $book->publishers()->detach();
        $book->items()->delete();
        $book->delete();

        return redirect('/books');
    }
}
