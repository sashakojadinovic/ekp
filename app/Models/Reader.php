<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $fillable =[
        'card_id',
            'name',
            'email',
            'occupation',
            'address',
            'city',
            'city_code',
            'phone_number',
            'comment'

    ];
    use HasFactory;
    public function borrowing(){
        return $this->hasOne(Borrowing::class);
    }
}
