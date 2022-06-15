<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Item;
use App\Models\Reader;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowings = Borrowing::all()->sortByDesc('created_at');
        return view('borrowing.borrowings',['borrowings'=>$borrowings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $item = Item::find($request->id);
        return view('borrowing.borrowing-create',['id'=>$request->id, 'item'=>$item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request);
        if(!$request->reader_array && !$request->reader_card){
            return back()->withErrors(['empty_fields'=>'Morate uneti ili broj članske karte ili pronaći korisnika po imenu']);
        }
        $borrowing = new Borrowing;
        $content = $request->validate([
            'item_id'=>'required',
            'reader_card'=>'present',
            'reader_array'=>'present'
        ]);
        if($content['reader_card']){
            $reader = Reader::where('card_id','=', $content['reader_card']);
        }
        else{
            $reader = Reader::where('id','=', $content['reader_array']);
        }

        if(!$reader->first()){
            return back()->withErrors('Nije pronađen čitalac sa datim brojem članske karte');
        }
        $borrowing->reader_id = $reader->first()->id;
        $borrowing->item_id=$content['item_id'];
        $borrowing->save();
        return redirect("/readers/$borrowing->reader_id");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function show(Borrowing $borrowing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrowing $borrowing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrowing $borrowing)
    {
        //dd($borrowing);
        $borrowing->delete();
        return redirect()->back();
    }
}
