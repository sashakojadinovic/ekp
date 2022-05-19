<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();
        return view('publisher.publishers',['publishers'=>$publishers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publisher.publisher-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $publisher = new Publisher;
       $content = $request->validate([
           'name'=>'required',
           'info'=>'present'
       ]);
       $publisher->name = $content['name'];
       $publisher->info =$content['info'];
       $publisher->save();
       return redirect("/publishers/$publisher->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        $publishers_books = $publisher->books()->get();
        return view('publisher.publisher',['publisher'=>$publisher,'publishers_books'=>$publishers_books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view('publisher.publisher-edit',['publisher'=>$publisher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $content = $request->validate([
            'name'=>'required',
            'info'=>'present'
        ]);
        $publisher->update([
            'name'=>$content['name'],
            'info'=>$content['info']
        ]);
        return redirect("/publishers/$publisher->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->books()->detach();
        $publisher->delete();
        return redirect("/publishers");
    }
}
