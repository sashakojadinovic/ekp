<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;
protected $fillable=["title","image", "short_desc"];


    public function tags(){
        return $this->belongsToMany(Tag::class,"tag_blogs");
    }

    public function text($text, $delete=null){
        if($delete){
            Storage::put("text.txt",$text);

        }
        else{
            if(Storage::disk("local")->exists("text.txt")){
                Storage::append("text.txt",$text);
            }
            else{
                Storage::disk("local")->put("text.txt",$text);
            }
        }
    }
}
