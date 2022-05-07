<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\mailSaSajta;
use App\Models\Blog;
use App\Models\Donator;
use App\Models\Site\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{
    public function donors(){
        $donors=Donor::where("donor_partner",1)->get();
        $partners=Donor::where("donor_partner",0)->get();
        return view("site.donors",["donors"=>$donors, "partners"=>$partners]);
    }


    public function community(){
        return view("site.ukljucise");

    }

    public function contact(){
        return view("site.kontakt");

    }
    public function prostor(){
        return view("site.prostor");

    }
    public $email;
    public function sentMail(Request $request){
        $request->validate([
            "email"=>'required|email',
            "tekst"=>'required'
        ],[
            'required'=>":attribute je obavezno polje",
            'email'=>"Email nije u dobroj formi."
        ]);
        $this->email=$request->input("email");
            $text=$request->input("tekst");
            $details=["text"=>$text, "email"=>$this->email];
            Mail::to("nelica.stojadinovic@gmail.com")->send(new mailSaSajta($details));
//        Mail::send(['text'=>"emails.saSajta"], [], function($message)  {
//            $message->subject('Email sa sajta');
//            $message->from($this->email);
//            $message->to("nelica.stojadinovic@gmail.com");
//        });
        return back();

    }

    public function blog(){
        $blogs=Blog::with("tags")->paginate(4);
        $blogs->each(function ($item) {
            $string=$item["created_at"]->format('d.m.Y').", ".$item["created_at"]->getTranslatedDayName("MMMM YYYY").", ";
            $string=$string."u ".$item["created_at"]->format('H:i')." h";
             $item["datum"]=$string;

        });
        return view("site.blog", ["blogs"=>$blogs]);

    }

    public function showBlog($id){
        $blog=Blog::where("id",$id)->with("tags")->first();
        $html="";
      if(Storage::disk("local")->exists("text.txt")){
            $content=Storage::get("text.txt");

          $content=explode("{",$content);

            foreach ($content as $item){
                $item=explode("}",$item);
                if($item[0]==$blog->id){
                    $html=$item[1];
                }

            }
        }
//        $blogs->each(function ($item) {
//
//
//            $string=$item["created_at"]->format('d.m.Y').", ".$item["created_at"]->getTranslatedDayName("MMMM YYYY").", ";
//            $string=$string."u ".$item["created_at"]->format('H:i')." h";
//             $item->created_at=$string;
//
//        });
        return view("site.blogOne", ["blog"=>$blog, "html"=>$html]);

    }
}
