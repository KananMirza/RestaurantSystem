<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    public function index(){
        $currentday = date('Y-m-d H:i:s');
        $slider = slider::where([['status','1'],['publish_date','<=',$currentday],['finish_date','>=',$currentday]])->get();
        View::share('sliders',$slider);
        return view("index");
    }
}
