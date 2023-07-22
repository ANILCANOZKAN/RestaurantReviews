<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters){

        $query->when($filters['search'] ?? false, fn($query, $search)=>
        $query->where(fn($query) =>
        $query->where('ad', 'like', '%' .$search. '%'))
        );

        $query->when($filters['category'] ?? false, fn($query, $category)=>
        $query->whereHas('category' , fn($query) =>
        $query->where('slug', $category)));

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }

    public function comment()
    {
        return $this->hasMany(Reply::class);
    }

}
