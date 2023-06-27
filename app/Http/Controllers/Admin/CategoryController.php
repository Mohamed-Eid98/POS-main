<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function Add(){
        return view('category.categoryAdd');
    }


    public function Store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'pic' => 'image|required',
        ],[

            'name.required' =>'يرجي ادخال اسم القسم',
            'name.unique' =>'هذا القسم مسجل مسبقا',
            'pic.required' =>'يرجي ادخال صوره ',
        ]);


        if($request->file('pic')){
            // dd('sa');
            $file= $request->file('pic');
            $fileName = date('YmdHi'). $file->getClientOriginalName();
            $file->move(public_path('uploads/category/'),$fileName);
            $save_url = 'uploads/category/' .$fileName;

            Category::create([
                'name' => $request->name,
                'image' => $save_url
        ]);
        }else{
            Category::create([
                'name' => $request->name,
            ]);
        }

    session()->flash('Add', 'تم اضافة القسم بنجاح ');

    return redirect()->back();
}

public function Show()
{
    $categories = Category::latest()->get();
    return view('category.categoryView' , compact('categories'));
}
public function showPage($id)
{
    $category = subCategory::with('category')->find($id);
    // return $category;
    return view('category.categoryViewPage' , compact('category'));
}


public function Edit($id)
{
    $category = Category::find($id);
    // dd('as');
    return view('category.categoryEdit' , compact('category'));
}
public function Update(Request $request)
{
    $id  = $request->id;
    $old_image  = $request->old_image;

    if($request->file('pic')){
        unlink(public_path($old_image));
        $file= $request->file('pic');
        $fileName = date('YmdHi'). $file->getClientOriginalName();
        $file->move(public_path('uploads/category/'),$fileName);
        $save_url = 'uploads/category/' .$fileName;

        Category::find($id)->update([
            'name' => $request->name,
            'image' => $save_url,
        ]);
        // dd('asd');
    }else{
        Category::find($id)->update([
            'name' => $request->name,
        ]);
    }

session()->flash('edit', 'تم تعديل القسم بنجاح ');

        return redirect()->route('category.show');

}

public function Delete($id)
{
    $category= Category::findOrfail($id);
    unlink(public_path($category->image));
    Category::find($id)->delete();
    session()->flash('delete', 'تم حذف القسم بنجاح ');
    return redirect()->back();

}


}

