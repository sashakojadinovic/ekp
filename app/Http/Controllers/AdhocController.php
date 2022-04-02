<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

//use App\Models\Author;

class AdhocController extends Controller
{
    //
    public function store(Request $request)
    {
        //dd($request->m);
        //$model = (object) null;
        switch ($request->model) {
            case 'Author':
                $res = \App\Models\Author::where('name', '=', $request->data)->first();
                if ($res === null) {
                    $model = new \App\Models\Author;
                    $model->name = $request->data;
                    $model->save();
                    return $model;
                } else {
                    return $res->first()->name;
                }
                break;
            case 'Category':
                $res = \App\Models\Category::where('name', '=', $request->data)->first();
                if ($res === null) {
                    $model = new \App\Models\Category;
                    $model->name = $request->data;
                    $model->save();
                    return $model;
                } else {
                    return $res;
                }
                break;
                case 'Publisher':
                    $res = \App\Models\Publisher::where('name', '=', $request->data)->first();
                    if ($res === null) {
                        $model = new \App\Models\Publisher;
                        $model->name = $request->data;
                        $model->save();
                        return $model;
                    } else {
                        return $res;
                    }
                    break;
            default:
                return 1;
        }
    }
}
