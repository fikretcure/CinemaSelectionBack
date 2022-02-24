<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaFilm extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function film()
    {
        return $this->hasOne(Film::class,"id","film_id");
    }
}
