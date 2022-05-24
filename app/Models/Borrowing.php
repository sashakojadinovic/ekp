<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrowing extends Model
{
    use HasFactory, SoftDeletes;
    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function reader(){
        return $this->belongsTo(Reader::class);
    }
}

