<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Donator;
use App\Models\Publisher;
use App\Models\Category;

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
                $result = Author::where('name', 'LIKE', '%' . $request->q . '%')->get(['id', 'name']);
                break;
            case "Donator":
                $result = Donator::where('name', 'LIKE', '%' . $request->q . '%')->get(['id', 'name']);
                break;
            case "Publisher":
                $result = Publisher::where('name', 'LIKE', '%' . $request->q . '%')->get(['id', 'name']);
                break;
            case "Category":
                $result = Category::where('name', 'LIKE', '%' . $request->q . '%')->get(['id', 'name']);
                break;
            default:
                $result = [];
        }
        return response()->json($result);
    }
}
