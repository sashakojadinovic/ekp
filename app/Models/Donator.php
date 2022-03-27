<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donator extends Model
{
    protected $fillable = [
        'name', 'info'
    ];
    use HasFactory;
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
