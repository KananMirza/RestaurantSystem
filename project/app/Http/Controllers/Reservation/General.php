<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Models\reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class General extends Controller
{
    public function reservationIndex(){
        $reserv=reservation::all();
        View::share('reservs',$reserv);
    return view("reservation.reserv");
    }
}
