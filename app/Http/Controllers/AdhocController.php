<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Author;

class AdhocController extends Controller
{
    //
    public function store(Request $request){
        //dd($request->m);
        $model = 'App'.'\\'.'Models'.'\\'.$request->model;
        $res = $model::where('name','=',$request->data)->first() ;
        if($res===null){
            $author = new \App\Models\Author;
            $author->name=$request->data;
            $author->save();

            return $author;
        }
        else{
            return $res->first()->name;
        }


    }
}
