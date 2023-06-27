<?php

namespace App\Http\Controllers;

use datatables;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    function Add(){
        return view('category.categoryAdd');
    }
    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ],[

            'name.required' =>'يرجي ادخال اسم القسم',
            'name.unique' =>'هذا القسم مسجل مسبقا',
        ]);

    Category::create([
        'name' => $request->name,
    ]);
    session()->flash('Add', 'تم اضافة القسم بنجاح ');

    return redirect()->back();
}

public function Show()
{
    $categories = Category::latest()->get();
    return view('category.categoryView' , compact('categories'));
}


public function Edit($id)
{
    $category = Category::find($id);
    return view('category.categoryEdit' , compact('category'));
}
public function Update(Request $request)
{
    $id  = $request->id;
Category::find($id)->update([
    'name' => $request->name,
]);
session()->flash('edit', 'تم تعديل القسم بنجاح ');

        return redirect()->route('category.show');

}

public function Delete($id)
{
    Category::find($id)->delete();
    session()->flash('delete', 'تم حذف القسم بنجاح ');
    return redirect()->back();

}


}
