<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\CinemaFilm;
use App\Models\City;
use App\Models\CityCinemas;
use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Film::create(["name" => "nefes"]);
        Film::create(["name" => "kırmızı aşk"]);
        Film::create(["name" => "istanbulda rüzgar"]);
        Film::create(["name" => "güzel ailem"]);
        Film::create(["name" => "kılıcın nefreti"]);
        Film::create(["name" => "hacker olamazsın"]);
        /*  */
        Cinema::create(["name" => "Şehir Sinemaları"]);
        Cinema::create(["name" => "Sinemacım"]);
        Cinema::create(["name" => "Davutpaşa Sineması"]);
        Cinema::create(["name" => "Of Kültür Merkezi"]);
        Cinema::create(["name" => "Pelican Mall Cinema Pink"]);
        Cinema::create(["name" => "Bahçelievler Metroport"]);
        Cinema::create(["name" => "Beyoğlu Atlas"]);
        /*  */
        City::create(["name" => "istanbul"]);
        City::create(["name" => "trabzon"]);
        City::create(["name" => "antalya"]);
        City::create(["name" => "ankara"]);
        City::create(["name" => "bursa"]);
        City::create(["name" => "artvin"]);
        City::create(["name" => "edirne"]);
        City::create(["name" => "bilecik"]);
        /*  */
        City::get()->each(function ($item, $key) {
            $city_id = $item->id;
            Cinema::get()->each(function ($item, $key) use ($city_id) {
                CityCinemas::create([
                    "city_id" => $city_id,
                    "cinema_id" => $item->id,
                ]);
            });
        });
        /*  */
        Cinema::get()->each(function ($item, $key) {
            $cinema_id = $item->id;
            Film::get()->each(function ($item, $key) use ($cinema_id) {
                CinemaFilm::create([
                    "cinema_id" => $cinema_id,
                    "film_id" => $item->id,
                ]);
            });
        });
    }
}
