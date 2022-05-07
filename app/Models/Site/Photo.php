<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Photo extends Model
{
    use HasFactory;
protected $fillable=["image", "event_id"];

    public function event(){
        return $this->belongsTo(Event::class, "event_id", "id");
    }


    public function project(){
        return $this->hasOneThrough(Project::class, Event::class, "id", "id", "event_id", "project_id" );
    }
}
