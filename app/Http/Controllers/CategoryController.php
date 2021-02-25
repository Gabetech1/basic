<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function allCat(){
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function addCat(Request $request){
        $validateData = $request->validate([
            'category_name' => 'required|unique:category',
        ],
        [
            'category_name.required' => 'Please add a Category name'
        ]
    );
        //METHED FOR SAVING/INSERTING A DATA 1
        /* Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]); */

        //METHED FOR SAVING/INSERTING A DATA 2
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();


        return Redirect()->back()->with('success','Category inserted successfully');

    }

    public function editCat($id){
        //dd($id);
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function updateCat(Request $request, $id){
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        return Redirect()->route('all.category')->with('success','Category inserted successfully');
    }


    public function softDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Delete Successfull');
    }

    public function restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restore Successfull');
    }

    public function pDelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permanently Deleted');
    }
}
