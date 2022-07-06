<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ItemController;
use App\Models\Book;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class CatalogController extends Controller
{
    public function index(){
        $categories=Category::all();
        $books=Book::with("items", "authors")->withCount("borrows", "items")
            ->paginate(15);
        return view("site.katalog", ["books"=>$books, "categories"=>$categories]);
}

public function filterBooks(Request $request){
    $books=Book::with("items", "authors");
    if($request->has("value")){
        $books ->where("title", "LIKE", "%".$request->input("value")."%");
    }
    if($request->input("valueAuthor")!=""){
        $books ->whereHas("authors", function ($i) use ($request) {
            return $i->where("name", "LIKE", "%".$request->input("valueAuthor")."%");
    });}

    if($request->input("category")!=0){
        $books->whereHas("categories", function ($i) use ($request) {
            return $i->where("categories.id", "=", $request->input("category"));

        });}
    $books=$books->withCount("borrows", "items");


    if($request->input("available")=="true"){
        $array=[];
        $available=$books->get();
        foreach ($available as $b) {
            if($b->borrows_count-$b->items_count!=0){
                $array[]=$b->id;
            }
        }
        $books=$books->whereIn("id",$array);
    }
    $books=$books->paginate(15);

    return json_encode($books);
}
}
