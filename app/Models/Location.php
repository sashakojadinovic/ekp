<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable=[
        'name','info'
    ];
    use HasFactory;
    public function Items(){
       return $this->hasMany(Item::class);
    }
}
