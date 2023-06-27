<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subCategory;
use App\Models\Product;


class SubCategoryController extends Controller
{
    public function Add(){
        $categories = Category::orderBy('name' , 'ASC')->get();
        return view('sub_category.SubCategoryAdd' , compact('categories'));
    }
    public function Store(Request $request)
    {
        $request->validate([
            'cate_id' => 'required',
            'name' => 'required|unique:sub_categories|max:255',
            'pic' => 'image|required',
        ],[

            'cate_id.required' =>'يرجي اختيار القسم الرئيسي',
            'name.required' =>'يرجي ادخال اسم القسم',
            'name.unique' =>'هذا القسم مسجل مسبقا',
            'pic.required' =>'يرجي ادخال صوره ',
        ]);
        if($request->file('pic')){
            // dd('sa');
            $file= $request->file('pic');
            $fileName = date('YmdHi'). $file->getClientOriginalName();
            $file->move(public_path('uploads/subcategory/'),$fileName);
            $save_url = 'uploads/subcategory/' .$fileName;

            subCategory::create([
                'category_id' => $request->cate_id,
                'name' => $request->name,
                'image' => $save_url
            ]);
        }else{

            subCategory::create([
                'category_id' => $request->cate_id,
                'name' => $request->name,
            ]);
        }


    session()->flash('Add', 'تم اضافة القسم بنجاح ');

    return redirect()->back();
}

public function Show()
{
    $subcategories = subCategory::latest()->get();
    return view('sub_category.SubCategoryView' , compact('subcategories'));
}


public function Edit($id)
{
    $categories = Category::orderBy('name' , 'ASC')->get();
    $subcategory = subCategory::find($id);
    return view('sub_category.SubCategoryEdit' , compact('categories' , 'subcategory'));
}
public function Update(Request $request)
{
    $id  = $request->id;
    $old_image  = $request->old_image;

    if($request->file('pic')){
        unlink(public_path($old_image));
        $file= $request->file('pic');
        $fileName = date('YmdHi'). $file->getClientOriginalName();
        $file->move(public_path('uploads/subcategory/'),$fileName);
        $save_url = 'uploads/subcategory/' .$fileName;

        subCategory::find($id)->update([
            'name' => $request->name,
            'category_id' => $request->cate_id,
            'image' => $save_url,
        ]);
        // dd('asd');
    }else{
        subCategory::find($id)->update([
            'name' => $request->name,
            'category_id' => $request->cate_id,

        ]);
    }
session()->flash('edit', 'تم تعديل القسم بنجاح ');

        return redirect()->route('subcategory.show');

}

public function Delete($id)
{
    $subcategry = subCategory::find($id);
    unlink(public_path($subcategry->image));
    subCategory::find($id)->delete();
    session()->flash('delete', 'تم حذف القسم بنجاح ');
    return redirect()->back();

}

}
