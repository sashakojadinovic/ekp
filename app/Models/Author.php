<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Book;

class Author extends Model
{
    protected $fillable = [
        'name', 'info'
    ];
    use HasFactory;
    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
