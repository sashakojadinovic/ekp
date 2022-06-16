<?php

namespace App\Http\Controllers;

use App\Models\Donator;
use Illuminate\Http\Request;

class DonatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$donators = Donator::all();
        $donators = Donator::orderBy('name')->simplePaginate(50);
        return view('donator.donators',['donators'=>$donators]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donator.donator-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $donator = new Donator;
        $content = $request->validate(
            [
                'name' => 'required',
                'info' => 'present'
            ]
        );
        $donator->name=$content['name'];
        $donator->info=$content['info'];
        $donator->save();
        return redirect("/donators/$donator->id");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function show(Donator $donator)
    {
        return view('donator.donator',['donator'=>$donator]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function edit(Donator $donator)
    {
        return view('donator.donator-edit',['donator'=>$donator]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donator $donator)
    {
        $content = $request->validate(
            [
                'name' => 'required',
                'info' => 'present'
            ]
        );

        $donator->update(['name'=>$content['name'],'info'=>$content['info']]);
        return redirect("/donators/$donator->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donator $donator)
    {
        //$donator->books()->delete();
        foreach($donator->items()->get() as $item){
            //$item->donator()->dissociate();
            $item->donator_id=0;
            $item->save();
        }
        $donator->delete();
        return redirect("/donators");
    }
}
