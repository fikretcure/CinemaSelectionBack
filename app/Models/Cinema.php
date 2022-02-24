<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cinemaFilms()
    {
        return $this->hasMany(CinemaFilm::class,"cinema_id","id");
    }
}
