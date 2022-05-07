<?php

namespace App\Http\Controllers;

use App\Models\Site\Event;
use App\Models\Site\Photo;
use App\Models\Site\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use mysql_xdevapi\Exception;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $value=$request->input("value");
            $e=Event::with(["project","photos"])->where("active",0)->where("title", "LIKE", "%".$value."%")->get();

        }
        else{
            $e=Event::with(["project","photos"])->where("active", 0)->get();
        }

        $first=Event::with(["project","photos"])->where("active", 1)->first();

        $events=new Event();
        $events=$events->withDate($e);
        if($first){
            $event=new Event();
            $event=$event->withDate($first);
        }
        else{
            $event=false;
        }

        if($request->ajax()) {
            return json_encode(["uspeh"=>"Uspešno obrisano!","event"=>$event, "events"=>$events]);

        }
        else{
            return view("events.events", ["events"=>$events, "event"=>$event]);


        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects=Project::all();
        return view("events.event-create", ["projects"=>$projects]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date=str_replace("T", " ", $request->input("date"));
        $request->merge([
            'date' => $date,
        ]);

        $values = $request->validate([
            'title'=>'required|string',
            'desc'=>'required',
            'project_id'=>'required|exists:projects,id,deleted_at,NULL',
            'date'=>'required|date',
            "coverImg"=>'required|file|image|mimes:jpg,jpeg,png'
        ]);

        try{
            \DB::beginTransaction();
            $imageName = time().$request->file('coverImg')->getClientOriginalName();
            $img = Image::make($request->file('coverImg')->path());
            $img->resize(300, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/posters/'.$imageName);
            $img = Image::make($request->file('coverImg')->path());
            $img->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/posters/'."glavna".$imageName);
                $values["coverImg"]=$imageName;
                $insert=Event::create($values);
            \DB::commit();
        }
        catch(\Exception $e){
            \DB::rollBack();

            dd($e);
        }

        return back()->with("success","Dodato!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::find($id);
        $projects=Project::all();
        $model=new Event();
        $model=$model->withDate($event);
        return view("events.event-edit", ["event"=>$model, "projects"=>$projects]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event=Event::find($id);
        if($request->input("date")!=null){
            $date=str_replace("T", " ", $request->input("date"));
            $request->merge([
                'date' => $date,
            ]);
        }


        $values = $request->validate([
            'title'=>'required|string',
            'desc'=>'required',
            'project_id'=>'required|exists:projects,id,deleted_at,NULL',
            'date'=>'nullable|date',
            "coverImg"=>'nullable|file|image|mimes:jpg,jpeg,png'
        ]);

        try{
            \DB::beginTransaction();
            $event->title=$request->input("title");
            $event->desc=$request->input("desc");
            $event->project_id=$request->input("project_id");
            if($request->hasFile("coverImg")){
                $imageName = time().$request->file('coverImg')->getClientOriginalName();
                $img = Image::make($request->file('coverImg')->path());
                $img->resize(300, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/posters/'.$imageName);
                $img = Image::make($request->file('coverImg')->path());
                $img->resize(900, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/posters/'."glavna".$imageName);

                File::delete('images/posters/'.$event->coverImg);
                File::delete('images/posters/'."glavna".$event->coverImg);
                $event->coverImg=$imageName;
            }

            if($request->input("date")!=null) {
                $event->date=$date;
            }

                $event->save();
            \DB::commit();
        }
        catch(\Exception $e){
            \DB::rollBack();

            dd($e);
        }

        return back()->with("success","Izmenjeno!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        $event=Event::find($id);
        if($event->active==1){
            return json_encode(["neuspeh"=>"Postavljeno je kao obaveštenje na sajtu, ne može da se izbriše. Promenite obaveštenje, pa tek onda obrišite."]);
        }
        $photo=Photo::where("event_id",$id)->get();
            $photo->map(function ($i){
                File::delete('images/gallery/'."mala".$i->image);
                File::delete('images/gallery/'."velika".$i->image);
                $i->delete();
            });
            File::delete('images/posters/'."glavna".$event->coverImg);
            File::delete('images/posters/'.$event->coverImg);

            $event->delete();
        $e=Event::with(["project","photos"])->where("active", 0)->get();
        $first=Event::with(["project","photos"])->where("active", 1)->first();

        $events=new Event();
        $events=$events->withDate($e);
        $event=new Event();
        $event=$event->withDate($first);}
        catch(Exception $e){
            return dd($e);
        }

        return json_encode(["uspeh"=>"Uspešno obrisano!","event"=>$event, "events"=>$events]);
    }

    public function photosShow($id)
    {
        $photos=Photo::with("event")->where("event_id",$id)->get();
        $event=Event::find($id);
        return view("events.photos-edit", ["photos"=>$photos, "event"=>$event]);
    }

    public function photos($id, Request $request)
    {

        if($request->hasFile("image")){
            $request->validate([
                "image.*"=>'required|file|image|mimes:jpg,jpeg,png'
            ]);
//            dd($request->validate());
            foreach ($request->file("image") as $img){
                $imageName = time().$img->getClientOriginalName();
                $image = Image::make($img->path());
                $image->resize(300, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/gallery/'."mala".$imageName);
                $image = Image::make($img->path());
                $image->resize(900, 900, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/gallery/'."velika".$imageName);
                Photo::create(["image"=>$imageName, "event_id"=>$id]);
            }
        }
        if($request->has("delete")){
         foreach ($request->input("delete") as $delete){
            $photo=Photo::find($delete);
             File::delete('images/gallery/'."mala".$photo->image);
             File::delete('images/gallery/'."velika".$photo->image);
             $photo->delete();
         }
        }
        return back()->with("success","Izmenjeno!!");

    }

    public function main($id){
        Event::where("active",1)->update(['active' => 0]);
        $event=Event::find($id);
        $event->active=1;
        $event->save();
        return back()->with("success","Izmenjeno obaveštenje na sajtu!");

    }
}
