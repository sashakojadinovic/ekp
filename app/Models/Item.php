<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public function book(){
        return $this->belongsTo(Book::class);
    }
    public function donator(){
        return $this->belongsTo(Donator::class);
    }
    public function borrowing(){
        return $this->hasOne(Borrowing::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
}
