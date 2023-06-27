<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Http\Request;

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
        ],[

            'cate_id.required' =>'يرجي اختيار القسم الرئيسي',
            'name.required' =>'يرجي ادخال اسم القسم',
            'name.unique' =>'هذا القسم مسجل مسبقا',
        ]);

    subCategory::create([
        'category_id' => $request->cate_id,
        'name' => $request->name,
    ]);
    session()->flash('Add', 'تم اضافة القسم بنجاح ');

    return redirect()->back();
}

public function Show()
{
    $subcategories = SubCategory::latest()->get();
    return view('sub_category.SubCategoryView' , compact('subcategories'));
}


public function Edit($id)
{
    $categories = Category::orderBy('name' , 'ASC')->get();
    $subcategory = SubCategory::find($id);
    return view('sub_category.SubCategoryEdit' , compact('categories' , 'subcategory'));
}
public function Update(Request $request)
{
    $id  = $request->id;
    subCategory::find($id)->update([
    'category_id' => $request->cate_id,
    'name' => $request->name,
]);
session()->flash('edit', 'تم تعديل القسم بنجاح ');

        return redirect()->route('subcategory.show');

}

public function Delete($id)
{
    Product::find($id)->delete();
    session()->flash('delete', 'تم حذف القسم بنجاح ');
    return redirect()->back();

}

}
