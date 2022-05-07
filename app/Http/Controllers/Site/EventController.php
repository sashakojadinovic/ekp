<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            if($request->input("date")=="all"){
                $e=Event::with(["project"])->where("date",">", Carbon::now("Europe/Belgrade"))->orderByRaw('abs( timestampdiff(second, current_timestamp, date)) asc ')->paginate(5);
            }
            else{
                $e=Event::with(["project"])->orderByRaw('abs( timestampdiff(second, current_timestamp, date)) asc ')->paginate(5);
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
            return view("site.events",["events"=>$events]);
    }
}
