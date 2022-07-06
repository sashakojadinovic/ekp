<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Author;
class Book extends Model
{
    protected $fillable = [
        'title','img_url', 'year', 'age', 'info'
    ];
    use HasFactory;
    public function authors(){
        return $this->belongsToMany(Author::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function publishers(){
        return $this->belongsToMany(Publisher::class);
    }
    public function items(){
        return $this->hasMany(Item::class);
    }

    public function  borrows(){
        return $this->hasManyThrough(Borrowing::class, Item::class);

    }



}
