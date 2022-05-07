<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=["name"];

    public function photo(){
//        return $this->hasManyThrough(Photo::class, Event::class, "events.project_idd", "eventss.id", "projjects.id", "photoss.event_id");
        return $this->hasManyThrough(Photo::class, Event::class, "project_id", "event_id", "event_id", "iid");
    }
}
