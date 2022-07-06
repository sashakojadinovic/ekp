<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Item;
use App\Models\Reader;
use App\Models\Site\Event;
use App\Models\Site\Photo;
use App\Models\Site\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index(){
    $projects=Project::all();
    $photos=Photo::all();
    $event=Event::where("active", 1)->with("project")->first();
    $e=new Event();
    $event=$e->withDate($event);
    return view("site.home", ["projects"=>$projects, "photos"=>$photos, "event"=>$event]);
}

public function count(){
    $events=Event::all()->count();
    $books=Item::all()->count();
    $readers=Reader::all()->count();
    return json_encode(["events"=>$events, "readers"=>$readers, "books"=>$books]);
}

}
