<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Models\reservation;
use Illuminate\Http\Request;

class General extends Controller
{
    public function reservIndex(){
        return view('reserv.reservation');
    }
    public function addreserv(Request $request){

        $request->validate([
            "datepicker_field" => "required",
            "time" => "required",
            "people" => "required",
            "name_reserve" => "required",
            "email_reserve" => "required",
            "telephone_reserve" => "required",
            "opt_message_reserve" => "required",
        ]);

        $reservation = reservation::create([
            'reserv_date'=>$request->datepicker_field,
            'time'=>$request->time,
            'guests'=>$request->people,
            'name'=>$request->name_reserve,
            'email'=>$request->email_reserve,
            'phone'=>$request->telephone_reserve,
            'detail'=>$request->opt_message_reserve,
        ]);

        return redirect()->back()->with($reservation->save() ? 'success' : 'error');
    }
}
