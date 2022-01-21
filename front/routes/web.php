<?php


use App\Http\Controllers\General\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reservation\General;
use App\Http\Controllers\Menu\General as Menu;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// homepage
Route::get("/",[IndexController::class,"index"])->name("index");

// for reservation
Route::get("/reservation",[General::class,"reservIndex"])->name("reservIndex");
Route::post("/reservation",[General::class,"addreserv"])->name("addreserv");
//for menu
Route::get("/menu",[Menu::class,"menuIndex"])->name("menuIndex");

