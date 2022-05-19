<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Event;
use App\Models\Site\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    public function index(Request $request){
        $kategorije=Project::all();
        if($request->ajax()){
            if($request->input("date")=="all"){
                $e=Event::with(["project"])->where("date",">", Carbon::now("Europe/Belgrade"))->orderByRaw('abs( timestampdiff(second, current_timestamp, date)) asc ');
            }
            else{
                $e=Event::with(["project"])->orderByRaw('abs( timestampdiff(second, current_timestamp, date)) asc ');
            }
            if($request->input("kat")!=0){
               $e= $e->whereHas("project", function ($i) use ($request){
                   return $i->where("id", $request->input("kat"));
               })->paginate(5);
            }
            else{
                $e= $e->paginate(5);
            }
        }
        else{
            $e=Event::with(["project"])->orderByDesc("date")->paginate(5);

//            $e=Event::with(["project"])->where("date",">", Carbon::now("Europe/Belgrade"))->orderByRaw('abs( timestampdiff(second, current_timestamp, date)) asc ')->paginate(5);

        }
        $events=new Event();
        $events=$events->withDate($e);
        if($request->ajax()) {
            return json_encode($events);
        }
//        dd($kategorije);
            return view("site.events",["events"=>$events, "kategorije"=>$kategorije]);
    }
}
