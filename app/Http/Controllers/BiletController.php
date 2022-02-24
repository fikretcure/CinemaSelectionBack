<?php

namespace App\Http\Controllers;

use App\Models\Bilet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function where_city_id_cinema_id_film_id($request)
    {
        return Bilet::where("city_id", $request->city_id)->where("cinema_id", $request->cinema_id)->where("film_id", $request->film_id);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required',
            'cinema_id' => 'required',
            'film_id' => 'required',
            'seats.*' => 'required|numeric|min:1|max:50',
        ]);
        if ($validator->fails()) {
            return  $this->catch($validator->errors()->first());
        }
        $sum_seat = $this->where_city_id_cinema_id_film_id($request)->count();
        if ($sum_seat + collect($request->seats)->count() > 10) {
            return $this->catch("Koltuk Sayısı Yetersiz ! " . (10 - $sum_seat) . " Adet koltuk kaldı !");
        }
        $data = collect();
        collect($request->seats)->each(function ($item, $key) use ($request, $data) {
            if ($this->where_city_id_cinema_id_film_id($request)->where("seat", $item)->first()) {
                $data->push($item);
            }
        });
        if ($data->count() > 0) {
            return $this->catch($data . " Numaralı koltuk(lar) doludur !");
        }
        collect($request->seats)->each(function ($item, $key) use ($request) {
            Bilet::create([
                "city_id"     => $request->city_id,
                "cinema_id"   => $request->cinema_id,
                "film_id"     => $request->film_id,
                "user_id"     => $request->user_id,
                "seat"     => $item
            ]);
        });
        return Bilet::count();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bilet  $bilet
     * @return \Illuminate\Http\Response
     */
    public function show(Bilet $bilet)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bilet  $bilet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bilet $bilet)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bilet  $bilet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bilet $bilet)
    {
        //
    }
    public function emptySeat(Bilet $bilet, Request  $request)
    {
        $full_seats = collect($this->where_city_id_cinema_id_film_id($request)->pluck("seat"));
        $seats = collect();
        for ($i = 1; $i < 51; $i++) {
            $seats->push($i);
        }
        $empty_seats = collect();
        $seats->diff($full_seats)->each(function ($item, $key) use ($empty_seats) {
            $empty_seats->push($item);
        });
        return $this->try($empty_seats);
    }
}
