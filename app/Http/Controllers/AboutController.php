<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function homeAbout(){
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeabout'));
    }

    public function addAbout(){
        return view('admin.home.create');
    }

    public function storeAbout(Request $request){
        HomeAbout::insert([
            'title' => $request->about_title,
            'sub_title' => $request->about_sub_title,
            'content' => $request->about_content,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success','About Inserted Successfully');
    }

    public function editAbout($id){
        $homeabout = HomeAbout::find($id);
        return view('admin.home.edit', compact('homeabout'));
    }

    public function updateAbout(Request $request, $id){
        HomeAbout::find($id)->update([
            'title' => $request->about_title,
            'sub_title' => $request->about_sub_title,
            'content' => $request->about_content,
        ]);

        return Redirect()->route('home.about')->with('success','About Updated Successfully');
    }

    public function deleteAbout($id){
        $delete = HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success','Content Delete Successfully');
    }
}
