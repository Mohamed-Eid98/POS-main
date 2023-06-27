<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\subCategory;
use App\Models\ColorProduct;
use Illuminate\Http\Request;
use App\Models\ColorProductSize;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function add(){
        $categories = Category::orderBy('name' , 'ASC')->get();
        $colors = Color::orderBy('name' , 'ASC')->get();
        $sizes = Size::orderBy('name' , 'ASC')->get();
        // return response()->view('my-view')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        return view('product.ProductAdd', compact('categories','colors' , 'sizes'));
    }

    public function AjaxShow($id){
        $sub_cate = SubCategory::where('category_id' , $id)->orderBy('name' , 'ASC')->get();
        // dd($sub_cate);
        return response()->json($sub_cate);
    }

    public function Store(Request $request)
    {

        // return $request;

        if($request->file('pic')){
            // dd('sa');
            $file= $request->file('pic');
            $fileName = date('YmdHi'). $file->getClientOriginalName();
            $file->move(public_path('uploads/product/'),$fileName);
            $save_url = 'uploads/product/' .$fileName;

            $product_id= Product::insertGetId([
                'name' => $request->name,
                'description' => $request->desc,
                'code' => $request->code,

                'sub_category_id' => 17,



                'price' => $request->price,
                'min_price' => $request->min_price,
                'increase_ratio' => $request->increase_ratio,
                'repeat_times' => $request->repeated_times,

                'image' => $save_url,
                'is_new' => $request->new,
                'is_on_sale' => $request->sale,
                'is_new_arrival' => $request->new_arrival,
                'is_best_seller' => $request->best_seller,


            ]);
        }else{

            $product_id= Product::insertGetId([
                'name' => $request->name,
                'description' => $request->desc,
                'code' => $request->code,

                'sub_category_id' => 17,



                'price' => $request->price,
                'min_price' => $request->min_price,
                'increase_ratio' => $request->increase_ratio,
                'repeat_times' => $request->repeated_times,

                'is_new' => $request->new,
                'is_on_sale' => $request->sale,
                'is_new_arrival' => $request->new_arrival,
                'is_best_seller' => $request->best_seller,
            ]);

            $color_product_id = ColorProduct::insertGetId([
                'product_id' => $product_id,
                'color_id' => $request->color,
            ]);

            $color_product_size_id = ColorProductSize::insertGetId([
                'color_product_id' => $color_product_id,
                'size_id' => $request->size,
            ]);

        }







    session()->flash('add', 'تم اضافة المنتج بنجاح ');

    return redirect()->back();
    }



















public function Show(){

    $products= Product::with('subcategory')->get();
    // return $products;
    return view('product.productView',compact('products'));
}
public function showSub($id){

    $product= Product::find($id);
    $subcategory= subCategory::where('id' , $product->sub_category_id)->first();
    // return $subcategory;
    return view('sub_category.subcategoryPage',compact('subcategory'));
}

public function Edit($id)
{
    $categories = Category::latest()->get();
    $subcategories = subCategory::latest()->get();
    $product = Product::find($id);

    $colors = Color::orderBy('name' , 'ASC')->get();
    // $color = ColorProduct::where('product_id' , $product->id)->first();


    $sizes = Size::orderBy('name' , 'ASC')->get();
    // $size= ColorProductSize::where('color_product_id' , $color->id)->first();
    return view('product.ProductEdit' ,  compact('categories','colors' , 'sizes' , 'product', 'subcategories'));
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
            'Subcategory_id' => $request->subcate_id,
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
            'Subcategory_id' => $request->subcate_id,
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
    // if($product->image){

    //     unlink(public_path('/uploads/product/'.$product->image));
    // }

    Product::findOrfail($id)->delete();
    session()->flash('delete', 'تم حذف المنتج بنجاح ');

    return redirect()->back();
}


}
