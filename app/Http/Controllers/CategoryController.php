<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function view()
    {
        $user = Sentinel::getUser();
        $values=Category::all();
        return view('admin.setup.add_categories', compact('user','values'));
    }

    public function store(Request $request)
    {
        $categories = new Category();
        $categories->title = $request->category;
        if ($request->parent_id == "") {
            $categories->parent_id = 0;
        } else {
            $categories->parent_id = $request->parent_id;
        }
        $categories->save();
        return redirect()->back()->with('success','Category Added!!');
    }

    public function delete($id){
        $category=Category::findOrFail($id);
        if($category->products->count() >0 ){
            Alert::error('Warning Title', 'Warning Message');
            return redirect()->back()->with('error','Delete Products of this Category First');
        }
        if($category->children->count() > 0){
            Alert::error('Warning Title', 'Warning Message');
            return redirect()->back()->with('error','Delete Child Categories First');
        }
        $category->delete();
        return redirect()->back()->with('success','Category Deleted!!');
    }
    public function edit(Request $request,$id){
        $category= Category::findOrFail($id);
        $category->title = $request->category_edit;
        $category->save();
        return redirect()->back()->with('success','Category Edited!!');
    }

}