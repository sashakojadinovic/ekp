<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Event extends Model
{

    use HasFactory, SoftDeletes;
    protected $fillable=["coverImg", "title", "desc", "project_id", "date","active"];

    public function project(){
        return $this->hasOne(Project::class, "id","project_id")->withTrashed();
    }

    public function photos(){
        return $this->hasMany(Photo::class, "event_id","id");

    }

    public function withDate($events){
        if(is_countable($events)){
        $events->each(function ($item,$key) {
            $string=Carbon::createFromFormat('Y-m-d H:i:s', $item->date)->format('d.m.Y');
            $string=$string." , ".Carbon::createFromFormat('Y-m-d H:i:s', $item->date)->getTranslatedDayName("MMMM YYYY").", u ";
            $string=$string.Carbon::createFromFormat('Y-m-d H:i:s', $item->date)->format('H:i')." h";
            $item->date=$string;
        });
        }
        else{

            $events->date= Carbon::createFromFormat('Y-m-d H:i:s', $events->date)->format('d.m.Y').
                 ", ".Carbon::createFromFormat('Y-m-d H:i:s', $events->date)->getTranslatedDayName("MMMM YYYY").", u "
                .Carbon::createFromFormat('Y-m-d H:i:s', $events->date)->format('H:i')." h";
        }
        return $events;
    }
}
