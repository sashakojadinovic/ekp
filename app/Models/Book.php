<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Author;
class Book extends Model
{
    protected $fillable = [
        'title', 'donator_id', 'info'
    ];
    use HasFactory;
    public function authors(){
        return $this->belongsToMany(Author::class);
    }
    public function donator()
    {
        return $this->belongsTo(Donator::class);
    }

}
