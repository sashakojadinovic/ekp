<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Models\Donator;
use App\Models\Item;
use App\Models\Reader;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $donators_count = Donator::all()->count();
        $items_count = Item::all()->count();
        $readers_count = Reader::all()->count();
        $borrowings_count = Borrowing::all()->count();
        return view('home',['donators_count'=>$donators_count,'items_count'=>$items_count,
        'readers_count'=>$readers_count,'borrowings_count'=>$borrowings_count]);
    }
}
