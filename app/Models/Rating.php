<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function restaurant(){
        return $this->hasMany(Restaurant::class);
    }

    public function user(){
        return $this->hasMany(User::class,'id');
    }
}
