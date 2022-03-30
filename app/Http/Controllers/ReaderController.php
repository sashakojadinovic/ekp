<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readers = Reader::all();
        return view('reader.readers',['readers'=>$readers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reader.reader-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reader = new Reader;
        $content = $request->validate([
            'card_id'=>'required',
            'name'=>'required',
            'email'=>'email',
            'occupation'=>'present',
            'address'=>'present',
            'city'=>'present',
            'city_code'=>'present',
            'phone_number'=>'present',
            'comment'=>'present',


        ]);
        $reader->card_id=$content['card_id'];
        $reader->name=$content['name'];
        $reader->name=$content['name'];
        $reader->email=$content['email'];
        $reader->occupation=$content['occupation'];
        $reader->address=$content['address'];
        $reader->city=$content['city'];
        $reader->city_code=$content['city_code'];
        $reader->phone_number=$content['phone_number'];
        $reader->comment=$content['comment'];
        $reader->save();
        return redirect("/readers/$reader->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function show(Reader $reader)
    {
        $borrowing_list = [];
        $borrowings = $reader->borrowing()->get();
        foreach($borrowings as $b){
            $book = $b->item()->first()->book()->first()->title;
            $signature = $b->item()->first()->signature;
            array_push($borrowing_list,(object)['id'=>$b->id,'book_title'=>$book,'signature'=>$signature, 'date'=>$b->created_at]);
        }
        return view('reader.reader',['reader'=>$reader,'borrowings'=>$borrowing_list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function edit(Reader $reader)
    {
        return view('reader.reader-edit',['reader'=>$reader]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reader $reader)
    {
        $content = $request->validate([
            'card_id'=>'required',
            'name'=>'required',
            'email'=>'email',
            'occupation'=>'present',
            'address'=>'present',
            'city'=>'present',
            'city_code'=>'present',
            'phone_number'=>'present',
            'comment'=>'present',


        ]);
        $reader->update([
            'card_id'=>$content['card_id'],
            'name'=>$content['name'],
            'email'=>$content['email'],
            'occupation'=>$content['occupation'],
            'address'=>$content['address'],
            'city'=>$content['city'],
            'city_code'=>$content['city_code'],
            'phone_number'=>$content['phone_number'],
            'comment'=>$content['comment']
        ]);
        return redirect("/readers/$reader->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reader $reader)
    {
        $reader->delete();
        return redirect("/readers");
    }
}
