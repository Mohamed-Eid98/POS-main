<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add(){
        $categories = Category::orderBy('name' , 'ASC')->get();
        return view('product.productAdd', compact('categories'));
    }

    public function AjaxShow($id){
        $sub_cate = subCategory::where('category_id' , $id)->orderBy('name' , 'ASC')->get();
        // dd($sub_cate);
        return response()->json($sub_cate);
    }

    public function Store(Request $request)
    {

        if($request->file('main_thambnail')){
            $file= $request->file('main_thambnail');
            $fileName = date('YmdHi'). $file->getClientOriginalName();
            $file->move(public_path('uploads/'),$fileName);
        }

        Product::create([
            'category_id' => $request->cate_id,
            'subcategory_id' => $request->subcate_id,
            'name' => $request->name,
            'description' => $request->short_desc,
            'product_photo' => $request->main_thambnail,

            'selling_price' => $request->price,
            'min_price' => $request->min_price,
            'increase_ratio' => $request->increase_ratio,
            'product_qty' => $request->count,
            'code' => $request->code,

            'is_new' => $request->is_new,
            'on_sale' => $request->on_sale,
            'new_arrival' => $request->new_arrival,
            'best_seller' => $request->best_seller,
            'product_photo'=>$fileName

        ]);



        session()->flash('add', 'تم اضافة المنتج بنجاح ');

        return redirect()->back();
}


public function Show(){

    $products= Product::get();
    return view('product.productView',compact('products'));
}

public function Edit($id)
{
    $categories = Category::latest()->get();
    $subcategories = subCategory::latest()->get();
    $product = Product::find($id);
    return view('product.ProductEdit' , compact('categories' , 'subcategories' , 'product'));
}
public function Update(Request $request)
{
    $id =$request->id;
    $old_pic =$request->photo;

    if($request->file('main_thambnail')){
        unlink(public_path('uploads/'.$old_pic));
        $file= $request->file('main_thambnail');
        $fileName = date('YmdHi'). $file->getClientOriginalName();
        $file->move(public_path('uploads/'),$fileName);

        Product::findOrFail($id)->update([
            'category_id' => $request->cate_id,
            'subcategory_id' => $request->subcate_id,
            'name' => $request->name,
            'description' => $request->short_desc,
            'product_photo' => $request->main_thambnail,

            'selling_price' => $request->price,
            'min_price' => $request->min_price,
            'increase_ratio' => $request->increase_ratio,
            'product_qty' => $request->count,
            'code' => $request->code,

            'is_new' => $request->is_new,
            'on_sale' => $request->on_sale,
            'new_arrival' => $request->new_arrival,
            'best_seller' => $request->best_seller,
            'product_photo'=>$fileName
        ]);

    }else{

        Product::findOrFail($id)->update([
            'category_id' => $request->cate_id,
            'subcategory_id' => $request->subcate_id,
            'name' => $request->name,
            'description' => $request->short_desc,
            'product_photo' => $request->main_thambnail,

            'selling_price' => $request->price,
            'min_price' => $request->min_price,
            'increase_ratio' => $request->increase_ratio,
            'product_qty' => $request->count,
            'code' => $request->code,

            'is_new' => $request->is_new,
            'on_sale' => $request->on_sale,
            'new_arrival' => $request->new_arrival,
            'best_seller' => $request->best_seller,
        ]);
    }



    session()->flash('edit', 'تم تعديل المنتج بنجاح ');

        return redirect()->route('product.show');


}






public function Delete($id)
{


    $product= Product::findOrfail($id);
    unlink(public_path('uploads/'.$product->product_photo));
    Product::findOrfail($id)->delete();

    session()->flash('delete', 'تم حذف المنتج بنجاح ');

    return redirect()->back();
}


}
