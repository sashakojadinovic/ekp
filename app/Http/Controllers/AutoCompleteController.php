<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Donator;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Item;
use App\Models\Reader;

class AutoCompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function searchFor(Request $request)
    {

        //m - model, q-query
        $result = [];
        switch ($request->m) {
            case "Author":
                $result = Author::where($request->f, 'LIKE', '%' . $request->q . '%')->take(10)->get(['id', $request->f]);
                break;
            case "Donator":
                $result = Donator::where($request->f, 'LIKE', '%' . $request->q . '%')->take(10)->get(['id', $request->f]);
                break;
            case "Publisher":
                $result = Publisher::where($request->f, 'LIKE', '%' . $request->q . '%')->take(10)->get(['id', $request->f]);
                break;
            case "Category":
                $result = Category::where($request->f, 'LIKE', '%' . $request->q . '%')->take(10)->get(['id', $request->f]);
                break;
            case "Item":
                $result = Item::where($request->f, 'LIKE', '%' . $request->q . '%')->take(10)->get(['id', $request->f]);
                break;
            case "Reader":
                $result = Reader::where($request->f, 'LIKE', '%' . $request->q . '%')->take(10)->get(['id', $request->f]);
                break;
            default:
                $result = [];
        }
        return response()->json($result);
    }
}
