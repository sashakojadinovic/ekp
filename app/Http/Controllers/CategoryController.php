<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.categories',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.category-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $content = $request->validate([
            'name'=>'required',
            'prefix'=>'required',
            'info'=>'present'
        ]);
        $category->name=$content['name'];
        $category->prefix=$content['prefix'];
        $category->info=$content['info'];
        $category->save();
        return redirect('/categories');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories_book = $category->books()->get();
        return view('category.category', ['category'=>$category,'categories_book'=>$categories_book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.category-edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $content = $request->validate([
            'name'=>'required',
            'prefix'=>'required',
            'info'=>'present'
        ]);
        $category->update(['name'=>$content['name'],'prefix'=>$content['prefix'],'info'=>$content['info']]);
        return redirect("/categories/$category->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->books()->first()){
            return back()->withErrors(['notempty'=>'Kategorija ne može biti izbrisana dok postoje izdanja u toj kategoriji']);
        }
        $category->delete();
        return redirect('/categories');
    }
}
