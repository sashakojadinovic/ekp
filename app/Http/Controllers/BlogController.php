<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs=Blog::with("tags")->get();
//        $blogs->each(function ($item) {
//
//            $string=Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d.m.Y');
////            $string=$string." , ".Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->getTranslatedDayName("MMMM YYYY").", u ";
////            $string=$string.Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('H:i')." h";
//            $item->created_at=$string;
//        });
        return view("blogs.blogs", ["blogs"=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags=Tag::all();
        return view("blogs.blog-create", ["tags"=>$tags]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->input("tags"));
        $desc=$request->input("desc");
        $values = $request->validate([
            'title'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'tags.*'=>'nullable|exists:tags,id',
            "image"=>'required|file|image|mimes:jpg,jpeg,png'

        ],
            ['required'=>"Polje :attribute je obavezno za unos.",
               'mimes'=>"Slika mora da bude u formatu jpg, png ili jpeg.",
                'image'=>"Slika mora da bude u formatu jpg, png ili jpeg." ]);

        try{
            \DB::beginTransaction();

            if($request->file('image')){
                $imageName = time().$request->file('image')->getClientOriginalName();
                $img = Image::make($request->file('image')->path());
                $img->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/blogs/'. $imageName);
                $values["image"]=$imageName;
                $insert=Blog::create($values)->id;
            }
            if($request->input("tags")!=null){
                $blog=Blog::find($insert);
                $blog->tags()->attach($request->input("tags"));
            }
            $write = new Blog();
            $text = "{".$insert."}".$desc;

            $write->text($text);
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
        $blog=Blog::with("tags")->find($id);
        $tags=Tag::all();
        $html="";
        if(Storage::disk("local")->exists("text.txt")){
            $content=Storage::get("text.txt");
            $content=explode("{",$content);
            foreach ($content as $item){
                if($item==""){continue;}
                $item=explode("}",$item);
                if($item[0]==$blog->id){
                    $html=$item[1];}
            }
            }
        return view("blogs.blog-edit", ["blog"=>$blog, "tags"=>$tags, "html"=>$html]);
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
        $blog=Blog::find($id);
        $desc=$request->input("desc");
        $values = $request->validate([
            'title'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'tags.*'=>'nullable|exists:tags,id',
            "image"=>'nullable|file|image|mimes:jpg,jpeg,png'

        ],
            ['required'=>"Polje :attribute je obavezno za unos.",
                'mimes'=>"Slika mora da bude u formatu jpg, png ili jpeg.",
                'image'=>"Slika mora da bude u formatu jpg, png ili jpeg." ]);

        try{
            \DB::beginTransaction();
            $blog->title=$request->input("title");
            $blog->short_desc=$request->input("short_desc");
            if($request->hasFile('image')){
                $imageName = time().$request->file('image')->getClientOriginalName();
                $img = Image::make($request->file('image')->path());
                $img->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('images/blogs/'. $imageName);
                File::delete('images/blogs/'.$blog->image);
                $blog->image=$imageName;

            }
            if($request->input("tags")!=null){
                $blog->tags()->sync($request->input("tags"));
            }
            $text="";
            if(Storage::disk("local")->exists("text.txt")){
                $content=trim(Storage::get("text.txt"));
                $content=explode("{",$content);
                foreach ($content as $item){
                    if($item==""){continue;}
                    $item=explode("}",$item);
                    if($item[0]==$blog->id){
                        $text.="{".$blog->id."}".$request->input("desc");}
                    else{
                        $text.="{".$item[0]."}".$item[1];
                    }
                }
            }
            $write = new Blog();
            $write->text($text,true);

            $blog->save();
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
        $blog=Blog::find($id);
        $blog->tags()->detach();
        $text="";
        File::delete('images/blogs/'.$blog->image);
        if(Storage::disk("local")->exists("text.txt")){
            $content=trim(Storage::get("text.txt"));
            $content=explode("{",$content);
            foreach ($content as $item){
    if($item==""){continue;}
                $item=explode("}",$item);
                if($item[0]==$blog->id){
                    continue;}
                else{$text.="{".$item[0]."}".$item[1];
                }
            }
        }
        $write = new Blog();
        $write->text($text,true);
        $blog->delete();


        $blogs=Blog::with("tags")->get();
        return json_encode(["uspeh"=>"Uspešno obrisano!","blogs"=>$blogs]);

    }

    public function addTag(Request $request){

        $values = $request->validate([
            'name'=>'required|unique:tags'
        ],
        ['required'=>"Polje je obavezno za unos.",
            'unique'=>"Naziv taga već postoji u bazi."]);
    Tag::create($values);
$tags=Tag::all();
        return json_encode($tags);
    }
}
