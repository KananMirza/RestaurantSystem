<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Models\FoodCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Categories extends Controller
{
    public function getList()
    {
        $data = FoodCategories::all();
        View::share("data", $data);
        return view('foods.food_categories');
    }

    public function addCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $data = FoodCategories::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->back()->with($data ? "success" : "error", true);
    }

    public function viewCategory(Request $request)
    {
        $data = FoodCategories::find($request->id);
        if ($data) {
            return $data;
        }
        return 0;
    }

    public function updateCatagory(Request $request)
    {
        $validated = $request->validate([
            'edit_name' => 'required|min:3|max:255'
        ]);
        $category = FoodCategories::find($request->edit_id);
        $category->name = $request->edit_name;
        $category->slug = Str::slug($request->edit_name);
        $category->status = $request->edit_status;

        return redirect()->back()->with($category->save() ? "success" : "error", true);


    }
}
