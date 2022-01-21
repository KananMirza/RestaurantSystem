<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class General extends Controller
{
    public function generalIndex(){
        $settings = Settings::all();
        View::share("data",$settings);
        return view("settings.general");
    }

    public function contactIndex(){
        $settings = Settings::all();
        $phones = json_decode($settings[0]->phones,true);
        View::share("data",$settings);
        View::share("phones",$phones);


        return view("settings.contact");
    }
    public function generalIndexUpdate(Request $request){
        $data = Settings::find(1);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'keywords' => 'required|max:255',
        ]);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->keywords = $request->keywords;

        return redirect()->back()->with($data->save() ? 'success' : 'error', true);
    }
    public function contactIndexUpdate(Request $request){
        $data = Settings::find(1);
        $validated = $request->validate([
            'address' => 'required|max:500',
            'email' => 'required|max:255|email',
        ]);
        $data->address = $request->address;
        $data->email = $request->email;
        $data->phones = json_encode($request->phones);

        return redirect()->back()->with($data->save() ? 'success' : 'error', true);
    }

    public function socialIndex(){
            $data = Settings::all();
            $socials = json_decode($data[0]->social_networks,true);
            View::share("data",$socials);

            return view("settings.social");
    }

    public function socialIndexUpdate(Request $request){
        $data = Settings::find(1);
        $socials = json_decode($data->social_networks,true);

        $validated = $request->validate([
            'twitter' => 'required|max:255',
            'facebook' => 'required|max:255',
            'instagram' => 'required|max:255',
            'youtube' => 'required|max:255',
        ]);

        $socials[0] = $request->twitter;
        $socials[1] = $request->facebook;
        $socials[2] = $request->instagram;
        $socials[3] = $request->youtube;
        $data->social_networks = json_encode($socials,true);
        return redirect()->back()->with($data->save() ? 'success' : 'error', true);
    }

    public function aboutIndex(){
        $data = Settings::find(1);
        View::share("data",$data);
        return view("settings.about");
    }

    public function aboutPost(Request $request){
        $data = Settings::find(1);
        $data->about_content = $request->about;
        return redirect()->back()->with($data->save() ? 'success' : 'error', true);
    }

    public function sliderIndex(){
       $slider =  Slider::all();
        View::share('sliders',$slider);
        return view('settings.sliders');
    }
    public function addSlider(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'btn_title' => 'required|max:255',
            'url' => 'required|max:255',
            'publish_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:publish_date',
            'image'=>'image|mimes:jpg,jpeg,png|max:1024'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->title) .'-' .rand(1000,9999).'.' . $image->getClientOriginalExtension();
        $directory = 'assets/media/slider/';
        $image->move($directory, $name);
        $name = $directory.$name;

        $data = Slider::create([
            'title'=>$request->title,
            'btn_title'=>$request->btn_title,
            'url'=>$request->url,
            'publish_date'=>$request->publish_date,
            'finish_date'=>$request->end_date,
            'image'=>$name,
        ]);
        return redirect()->back()->with($data ? "success" : "error",true);
    }

    public function viewSlider(Request $request){
        $data = Slider::find($request->id);
        return $data ?? null;
    }

    public function deleteSlider($id){
        $data = Slider::find($id);
        if($data){
            if (file_exists($data->image)) {
                unlink($data->image);
            }
            $data->delete();
        }
        return redirect()->back();
    }
    public function editSlider(Request $request){
        $data= Slider::find($request->id);
        return $data ?? null;
    }
    public function updateSlider(Request $request){
        $slider = Slider::find($request->id);
        $validated = $request->validate([
            'edit_title' => 'required|max:255',
            'edit_btn_title' => 'required|max:255',
            'edit_url' => 'required|max:255',
            'edit_publish_date' => 'required|date',
            'edit_end_date' => 'required|date|after_or_equal:edit_publish_date',
            'edit_status'=>'required'
        ]);

        if ($request->hasFile('edit_image')) {
            $request->validate([
                'edit_image' => 'image|mimes:jpg,jpeg,png|max:1024'
            ]);
            $image = $request->file('edit_image');
            $name = Str::slug($request->title) .'-' .rand(1000,9999).'.' . $image->getClientOriginalExtension();
            $old_image = 'assets/media/slider/' . $slider->image;
            $directory = 'assets/media/slider/';
            if (file_exists($old_image) && $slider->image) {
                unlink($old_image);
            }
            $image->move($directory, $name);
            $name = $directory.$name;
            $slider->image = $name;
        }

        $slider->title=$request->edit_title;
        $slider->btn_title =$request->edit_btn_title;
        $slider->url=$request->edit_url;
        $slider->publish_date=$request->edit_publish_date;
        $slider->finish_date=$request->edit_end_date;
        $slider->status = $request->edit_status;

        return redirect()->back()->with($slider->save() ? "success" : "error",true);

    }

}
