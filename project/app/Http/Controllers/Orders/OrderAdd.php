<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\FoodCategories;
use App\Models\Foods;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrderAdd extends Controller
{
    public function orderAddView(){

        $categories = FoodCategories::where("status","1")->get();
        View::share("categories",$categories);
        return view('orders.get-order');
    }

    public static function getFoods($category_id){
        $data = Foods::where("category_id",$category_id)->where("status","1")->get();
        return $data;
    }

    public function addOrder(Request $request){

        $data = Order::create([
            'details'=> json_encode($request->Card,JSON_UNESCAPED_UNICODE),
            'sub_total'=> $request->sub,
        ]);
        return $data ? 1 : 0;
    }
    public function getWaitingOrder(){
        $orders = Order::where("status","5")->orderBy("id","DESC")->get();
        View::share("orders",$orders);
        return view('orders.waiting');
    }
    public function CancelOrder(Request $request){
        $request->validate([
            'cancel_content' => 'required'
        ]);
        $data = Order::find($request->id);
        $data->status = "0";
        $data->admin_note = $request->cancel_content;
        return redirect()->back()->with($data->save() ? "success" : "error",true);
    }
    public function setAcceptingOrder(Request $request){

        $data = Order::find($request->id);
        $data->status = "4";
        $data->save();
        return "1";
    }

    public  function getAcceptingOrder(){
        $orders = Order::where("status","4")->orderBy("id","DESC")->get();
        View::share("orders",$orders);
        return view('orders.accepting');
    }
    public function setPreparingOrder(Request $request){
        $data = Order::find($request->id);
        $data->status = "3";
        $data->save();
        return "1";
    }
    public function getPreparingOrder(){
        $orders = Order::where("status","3")->orderBy("id","DESC")->get();
        View::share("orders",$orders);
        return view('orders.preparing');
    }
    public function setOnWayOrder(Request $request){
        $data = Order::find($request->id);
        $data->status = "2";
        $data->save();
        return "1";
    }
    public function getOnWayOrder(){
        $orders = Order::where("status","2")->orderBy("id","DESC")->get();
        View::share("orders",$orders);
        return view('orders.onway');
    }
    public function setCompletedOrder(Request $request){
        $data = Order::find($request->id);
        $data->status = "1";
        $data->save();
        return "1";
    }
    public function getCompletedOrder(){
        $orders = Order::where("status","1")->orderBy("id","DESC")->get();
        View::share("orders",$orders);
        return view('orders.completed');
    }
    public function getCancelOrder(){
        $orders = Order::where("status","0")->orderBy("id","DESC")->get();
        View::share("orders",$orders);
        return view('orders.cancel-order');
    }


}
