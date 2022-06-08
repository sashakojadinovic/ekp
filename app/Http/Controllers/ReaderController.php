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
    public function index(Request $request)
    {
        if($request->search_term!=="" && $request->criteria==="card_id"){
            $readers = Reader::where('card_id','=',$request->search_term)->simplePaginate(100);
        }
        else if($request->filled('search_term')){
            $readers = Reader::where($request->criteria,'LIKE','%'.$request->search_term.'%')->simplePaginate(100);
        }
        else{
            $readers = Reader::simplePaginate(100);
        }

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
        //dd($request);
        $reader = new Reader;
        $content = $request->validate([
            'card_id'=>'present',
            'name'=>'required',
            'gender'=>'present',
            'date_of_birth'=>'nullable|date',
            'parents_name'=>'present',
            'email'=>'present',
            'occupation'=>'present',
            'address'=>'present',
            'city'=>'present',
            'city_code'=>'present',
            'phone_number'=>'present',
            'comment'=>'present',
        ]);
        //dd($content);
        //Ovo može bolje i elegantnije, ali sad nemam vremena da se bavim time
        if($content['card_id']){
            if(!Reader::where('card_id','=',$content['card_id'])->first()){
                $reader->card_id=$content['card_id'];
            }
            else{
                return back()->withErrors(['msg'=>'Članska karta sa tim brojem već postoji']);
                //$content['card_id']=null;
            }

        }
        $reader->name=$content['name'];
        $reader->gender=$content['gender'];
        $reader->email=$content['email'];
        $reader->occupation=$content['occupation'];
        $reader->address=$content['address'];
        $reader->city=$content['city'];
        $reader->city_code=$content['city_code'];
        $reader->phone_number=$content['phone_number'];
        $reader->comment=$content['comment'];
        $reader->save();
        //Ovde može biti problema ako se automatski dodeli broj koji je ranije unet manuelno
        if(!$content['card_id']){
            $reader->card_id=$reader->id;
            $reader->save();
        }
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
        //$borrowings = $reader->borrowing()->get();
        $borrowings = $reader->borrowing()->withTrashed()->get();
        foreach($borrowings as $b){
            $book = $b->item()->first()->book()->first();
            $signature = $b->item()->first()->signature;
            $returned = $b->deleted_at?:null;
            array_push($borrowing_list,(object)['id'=>$b->id,'book'=>$book,'signature'=>$signature,
             'date'=>date_format($b->created_at,"d.m.Y. H:i"), 'return_date'=>$b->deleted_at?date_format($b->deleted_at,"d.m.Y. H:i"):null]);
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
            'gender'=>'present',
            'date_of_birth'=>'nullable|date',
            'parents_name'=>'present',
            'email'=>'present',
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
            'gender'=>$content['gender'],
            'date_of_birth'=>$content['date_of_birth'],
            'parents_name'=>$content['parents_name'],
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
