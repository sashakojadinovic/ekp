<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Event;
use App\Models\Site\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GalleryController extends Controller
{
    public function index(Request $request){
            $photosPag=Photo::with(["project", "event"])->paginate(10);
            $photos=Photo::with(["project", "event"])->get();
//            $model=new Event();
            $photosPag->map(function($i){
                $string=Carbon::createFromFormat('Y-m-d H:i:s', $i->event->date)->format('d.m.Y');
                $string=$string." , ".Carbon::createFromFormat('Y-m-d H:i:s', $i->event->date)->getTranslatedDayName("MMMM YYYY").", u ";
                $string=$string.Carbon::createFromFormat('Y-m-d H:i:s', $i->event->date)->format('H:i')." h";
                $i["novDatum"]=$string;
            });
        return view("site.galerija", ["photos"=>$photos, "photosPag"=>$photosPag]);

//        }
    }
}
