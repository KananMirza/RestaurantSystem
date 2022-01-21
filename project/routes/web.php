<?php

use App\Http\Controllers\Foods\Foods;
use App\Http\Controllers\Orders\OrderAdd;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\General\General;
use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\Profile\General as ProfileGeneral;
use App\Http\Controllers\Foods\Categories as FoodCategories;
use App\Http\Controllers\Admin\General as adminGeneral;
use App\Http\Controllers\Settings\General as settingsGeneral;
use App\Http\Controllers\Reservation\General as Reserv;

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

Route::middleware('isLogout')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'login_post'])->name('login_post');
});


Route::middleware('isLogin')->group(function () {
    Route::get('/', [General::class, "index"])->name('index');
    Route::get('/logout', [LoginController::class, "logout"])->name('logout');

    //Profile
    Route::get('/my-profile', [ProfileGeneral::class, "myProfile"])->name('myProfile');
    Route::post('/my-profile', [ProfileGeneral::class, "myProfileEdit"])->name('myProfileEdit');

    // Admin
    Route::get('/admin/users', [adminGeneral::class, "getUsersList"])->name('getUsersList');
    Route::post('/admin/users', [adminGeneral::class, "UserUpdate"])->name('UserUpdate');
    Route::post('/admin/user/add', [adminGeneral::class, "UserAdd"])->name('UserAdd');
    Route::post('/admin/view/emp', [adminGeneral::class, "getEmpData"]);

    Route::get('/settings/general', [settingsGeneral::class, "generalIndex"])->name('generalIndex');
    Route::post('/settings/general', [settingsGeneral::class, "generalIndexUpdate"])->name('generalIndexUpdate');
    Route::get('/settings/contact', [settingsGeneral::class, "contactIndex"])->name('contactIndex');
    Route::post('/settings/contact', [settingsGeneral::class, "contactIndexUpdate"])->name('contactIndexUpdate');
    Route::post('/settings/contact/delete', [settingsGeneral::class, "contactIndexDelete"]);
    Route::get('/settings/social', [settingsGeneral::class, "socialIndex"])->name('socialIndex');
    Route::post('/settings/social', [settingsGeneral::class, "socialIndexUpdate"])->name('socialIndexUpdate');
    Route::get('/settings/about', [settingsGeneral::class, "aboutIndex"])->name('aboutIndex');
    Route::post('/settings/about', [settingsGeneral::class, "aboutPost"])->name('aboutPost');
    Route::get('/settings/slider', [settingsGeneral::class, "sliderIndex"])->name('sliderIndex');
    Route::post('/settings/slider', [settingsGeneral::class, "addSlider"])->name('addSlider');
    Route::post('/slider/view', [settingsGeneral::class, "viewSlider"]);
    Route::get('/slider/delete/{id}', [settingsGeneral::class, "deleteSlider"]);
    Route::post('/slider/edit/view', [settingsGeneral::class, "editSlider"]);
    Route::post('/slider/update', [settingsGeneral::class, "updateSlider"])->name('updateSlider');


    // Foods
    Route::get('/food/categories-list', [FoodCategories::class, "getList"])->name('getList');
    Route::post('/food/categories-add', [FoodCategories::class, "addCategory"])->name('addCategory');
    Route::post('/food/view/category', [FoodCategories::class, "viewCategory"]);

    Route::post('/food/edit/category', [FoodCategories::class, "updateCatagory"])->name('editCategory');

    Route::get('/food/list', [Foods::class, "viewList"])->name('viewList');
    Route::get('/food/add', [Foods::class, "viewAdd"])->name('viewAdd');
    Route::post('/food/add', [Foods::class, "foodAdd"])->name('foodAdd');
    Route::post('/food/view/{id}', [Foods::class, "viewFoodData"]);

    Route::get('/food/edit/{id}', [Foods::class, "viewFoodDetails"]);
    Route::post('/food/edit', [Foods::class, "foodEdit"])->name('foodEdit');
    Route::get('/food/delete/{id}', [Foods::class, "deleteFood"]);
    Route::post('/food/order/add', [OrderAdd::class, "addOrder"]);


    //Orders
    Route::get('/orders/add/', [OrderAdd::class, "orderAddView"])->name("orderAddView");
    Route::post('/orders/view/cancel', [OrderAdd::class, "CancelOrder"])->name("CancelOrder");

    Route::get('/orders/view/waiting', [OrderAdd::class, "getWaitingOrder"])->name("getWaitingOrder");
    Route::post('/orders/view/waiting/setacceptingorder', [OrderAdd::class, "setAcceptingOrder"]);

    Route::get('/orders/view/accepting', [OrderAdd::class, "getAcceptingOrder"])->name("getAcceptingOrder");
    Route::post('/orders/view/accepting/setpreparingorder', [OrderAdd::class, "setPreparingOrder"]);

    Route::get('/orders/view/preparing', [OrderAdd::class, "getPreparingOrder"])->name("getPreparingOrder");
    Route::post('/orders/view/preparing/setonway', [OrderAdd::class, "setOnWayOrder"]);

    Route::get('/orders/view/onway', [OrderAdd::class, "getOnWayOrder"])->name("getOnWayOrder");
    Route::post('/orders/view/onway/completed', [OrderAdd::class, "setCompletedOrder"]);

    Route::get('/orders/view/completed', [OrderAdd::class, "getCompletedOrder"])->name("getCompletedOrder");

    Route::get('/orders/view/canceled', [OrderAdd::class, "getCancelOrder"])->name("getCancelOrder");

    //reservation
    Route::get('/reservation', [Reserv::class, "reservationIndex"])->name("reservationIndex");



});

