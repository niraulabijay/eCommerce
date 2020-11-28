<?php

namespace App\Http\Controllers\admin;

use App\category;
use App\Special;
use App\SpecialCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function add_special()
    {
        $special = Special::all()->count();
        return view('admin.special_section.add_special_price', compact('special'));

    }

    public function post_special(Request $request)
    {
        $special = new Special();
        $special->special_price = $request->special_price;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/admin/images/special_by_price', $filename);
            $special->special_image = "/admin/images/special_by_price/" . $filename;
        };
        $special->save();
        return redirect()->back()->with('success','Added Successfully');
    }

    public function view_special()
    {
        $specials = Special::all();
        $special_categories = SpecialCategory::all();
        return view('admin.special_section.view_special_price', compact('specials','special_categories'));
    }

    public function delete_special_price($id)
    {
        $special = Special::findorfail($id);

        $filename=$special->special_image;
        if (file_exists(public_path() . '/' . $filename)) {
            unlink(public_path() . '/' . $filename);
        }
        $special->delete();
        return redirect()->back();
    }

    public function edit_special_price($id)
    {
        $special = Special::findorfail($id);
//        dd($shipping);
        return view('admin.special_section.edit_special_price', compact('special'));
    }

    public function save_edited_special_price(Request $request, $id)
    {
        $special = Special::findorfail($id);
        $special->special_price = $request->special_price;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/admin/images/special_by_price', $filename);
            $special->special_image = "/admin/images/special_by_price" . $filename;
        };
        $special->save();
        return redirect('/admin/special_view');
    }

    //Special Category

    public function index()
    {
        $all_categories = category::all();
        return view('admin.special_section.add_special_category',compact('all_categories'));
    }

    public function store(Request $request)
    {
//        dd($request);
        $special_category = new SpecialCategory();
        $special_category->category_name = $request->special_category;
        $special_category->status = 0;
        if ($request->hasFile('special_saree')) {
            $image = $request->file('special_saree');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $upload_path = 'admin/images/special_by_category/';
            $db_filename = $upload_path . $filename;
            $image->move($upload_path, $filename);
            $special_category->image = $db_filename;

        }
        $special_category->save();

        return redirect()->back()->with('success', 'Successfully added');
    }

    public function view()
    {
        $special_categories = SpecialCategory::all();
        return view('admin.special_section.special_view', compact('special_categories'));

    }

    public function delete($id)
    {
        $special = SpecialCategory::findorfail($id);


        $filename=$special->image;
        if (file_exists(public_path() . '/' . $filename)) {
            unlink(public_path() . '/' . $filename);
        }
        $special->delete();
        return redirect()->back();

    }

    public function confirm($id)
    {
        $special_category = SpecialCategory::findorfail($id);
        if ($special_category->status == 0) {
            $special_category->status = '1';
        } else {
            $special_category->status = '0';
        }
        $special_category->save();
        return redirect()->back();


    }

    public function edit($id)
    {
        $special_category = SpecialCategory::findorfail($id);
//        dd($special);
        return view('admin.special_section.edit_special_category', compact('special_category'));
    }

    public function post_edit($id, Request $request)
    {
        $special_category = SpecialCategory::findOrFail($id);
        $special_category->category_name = $request->special_category;
//        $special_category->status = 0;
        if ($request->hasFile('special_saree')) {
            $image = $request->file('special_saree');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $upload_path = 'admin/images/special_by_category/';
            $db_filename = $upload_path . $filename;
            $image->move($upload_path, $filename);
            $special_category->image = $db_filename;

        }
        $special_category->save();

        return redirect('/admin/special_view')->with('edited', 'Item has been edited');

    }
}
