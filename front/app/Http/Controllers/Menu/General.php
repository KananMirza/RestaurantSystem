<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class General extends Controller
{
    public function menuIndex(){
        $category = category::all();
        View::share('categories',$category);
        return view('menu.menu');
    }
}
