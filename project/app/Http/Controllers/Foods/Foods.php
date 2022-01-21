<?php

namespace App\Http\Controllers\Foods;
use App\Http\Controllers\Controller;

use App\Models\FoodCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Foods as FoodsModel;

class Foods extends Controller
{
    public function viewList(){
        $data =  FoodsModel::all();
        View::share('data',$data);
        return view('foods.foods-list');

    }
    public function viewAdd(){
        $categories = FoodCategories::all();
        View::share("categories",$categories);
        return view('foods.foods-add');
    }

    public function foodAdd(Request $request){

        $validated = $request->validate([
            'category' => 'required',
            'name' => 'required|min:3|max:255',
            'ingredient' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:1024'
        ]);

        $properties = [];
        for($i = 0; $i<count($request->properties);$i++){
            $properties[$i] = ['name' => $request["properties"][$i],'price' => $request["properties_price"][$i]];
        }
        $properties = json_encode($properties, JSON_UNESCAPED_UNICODE);

        $image = $request->file('image');
        $name = Str::slug($request->name) .'-' .rand(1000,9999).'.' . $image->getClientOriginalExtension();
        $old_image = 'assets/media/foods/' . $request->images;
        $directory = 'assets/media/foods/';
        $image->move($directory, $name);
        $name = $directory.$name;

        $data = FoodsModel::create([
            "category_id"=>$request->category,
            "name"=>$request->name,
            "img"=>$name,
            "ingredient"=>$request->ingredient,
            "price"=>$request->price,
            "time"=>$request->time,
            "properties"=>$properties,
        ]);
        return redirect()->back()->with($data ? "success" : "error",true);
    }

    public function viewFoodData(Request $request){
            $data = FoodsModel::find($request->id);
            if($data){
                return $data;
            }
            return 0;
    }

    public function  viewFoodDetails($id){
       $data = FoodsModel::find($id);
        View::share('data',$data);
        $categories = FoodCategories::all();
        View::share("categories",$categories);
        $properties = json_decode($data['properties']);
        View::share("properties",$properties);

      //  dd($properties[0]->name);
        return view('foods.food-edit');
    }

    public function foodEdit(Request $request){

        $data=FoodsModel::find($request -> id);
        $validated = $request->validate([
            'edit_category' => 'required',
            'edit_name' => 'required|min:3|max:255',
            'edit_ingredient' => 'required',
            'edit_price' => 'required'
        ]);

        $properties = [];
        for($i = 0; $i<count($request->properties);$i++){
            $properties[$i] = ['name' => $request["properties"][$i],'price' => $request["properties_price"][$i]];
        }
        $properties = json_encode($properties, JSON_UNESCAPED_UNICODE);
        if ($request->hasFile('edit_image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png|max:1024'
            ]);

            $image = $request->file('edit_image');
            $name = Str::slug($request->edit_name) .'-' .rand(1000,9999).'.' . $image->getClientOriginalExtension();
            $directory = 'assets/media/foods/';
            if (file_exists($data->img)) {
                unlink($data->img);
            }

            $image->move($directory, $name);
            $name = $directory.$name;
            $data->img = $name;
        }
        $data->category_id = $request->edit_category;
        $data->name = $request->edit_name;
        $data->ingredient = $request->edit_ingredient;
        $data->price = $request->edit_price;
        $data->time = $request->edit_time;
        $data->properties = $properties;
        $data->status = $request->edit_status;
        return redirect()->back()->with( $data->save() ? "success" : "error", true);


    }

    public function deleteFood($id){
        $data=FoodsModel::find($id);
        if (file_exists($data->img)) {
            unlink($data->img);
        }
        $data->delete();
        return redirect()->back();
    }

}
