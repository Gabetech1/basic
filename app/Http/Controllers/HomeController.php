<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;

class HomeController extends Controller
{
    public function homeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    public function addSlider(){
        return view('admin.slider.create');
    }

    public function storeSlider(Request $request){

        $slider_image = $request->file('slider_image');

        //NORMAL IMAGE UPLOAD
        /* $name_gen = hexdec(uniqid());
        $image_ext = strtolower($slider_image->getClientOriginalExtension());
        $img_name = $name_gen. '.'.$image_ext;
        $up_location = 'image/slider/';
        $last_img = $up_location.$img_name;
        $slider_image->move($up_location,$img_name); */

        //IMAGE UPLOAD USING INTERVENTION IMAGE
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

        $last_img = 'image/slider/'.$name_gen;

        Slider::insert([
            'title' => $request->slider_title,
            'description' => $request->slider_desc,
            'image' => $request->slider_image,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider inserted successfully');
    }

    public function editSlider($id){
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }
}
