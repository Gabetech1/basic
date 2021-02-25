<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;
class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function allBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function storeBrand(Request $request){
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:png,jpg,jpeg'
        ],
        [
            'brand_name.required' => 'Please input the brand name',
            'brand_name.min' => 'Brand name should not be less than 4 characters'
        ]);

        $brand_image = $request->file('brand_image');

        //NORMAL IMAGE UPLOAD
        /* $name_gen = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen. '.'.$image_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name); */

        //IMAGE UPLOAD USING INTERVENTION IMAGE
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand inserted successfully');
    }

    public function editBrand($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }


    public function updateBrand(Request $request, $id){
        $validateData = $request->validate([
            'brand_name' => 'required|min:4'
        ],
        [
            'brand_name.required' => 'Please input the brand name',
            'brand_name.min' => 'Brand name should not be less than 4 characters'
        ]);

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if($brand_image){

            $name_gen = hexdec(uniqid());
            $image_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen. '.'.$image_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Brand Updated Successfully');
        }else{

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Brand Updated Successfully');
        }


    }

    public function deleteBrand($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }

    public function multiPic(){
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));

    }

    public function storeImages(Request $request){

        $images = $request->file('image');

        foreach($images as $image){

            //IMAGE UPLOAD USING INTERVENTION IMAGE
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,200)->save('image/multi/'.$name_gen);

            $last_img = 'image/multi/'.$name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }
        return Redirect()->back()->with('success', 'Brand inserted successfully');
    }

    public function logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','You have logged out.');
    }
}
