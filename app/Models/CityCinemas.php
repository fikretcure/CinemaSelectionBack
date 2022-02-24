<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityCinemas extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cinemasByCityCinemas()
    {
        return $this->hasOne(Cinema::class,"id","cinema_id");
    }
}
