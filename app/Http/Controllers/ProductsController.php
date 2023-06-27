<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=products::all();
        $sections=sections::all();
        return view('product.products',compact('products','sections'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'product_name' => 'required|unique:products|max:255',
       ],[

           'product_name.required' =>'يرجي ادخال اسم المنتج',
           'product_name.unique' =>'اسم المنتج مسجل مسبقا',


       ]);
       $image = $request->file('image')->getClientOriginalName();
       $path=$request->file('image')->storeAS('photo',$image,'save');


           products::create([
                'product_name' => $request->product_name,
                'section_id'=>$request->section_id,
                'size' => $request->size,
                'description' => $request->description,
                'path'=>$path,
                'size' => $request->size,

                'min_price' => $request->min_price,
                'increase_ratio' => $request->increase_ratio,
                'code' => $request->code,
                'price' => $request->price,



            ]);
            session()->flash('Add', 'تم اضافة المنتج بنجاح ');
            return redirect('/section');

       }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
  $id=sections::where('section_name',$request->section_name)->first()->id;
  $product=products::findOrFail($request->product_id);

 $product->update([
 'product_name' => $request->product_name,
'description' => $request->description,
 'section_id' =>$id  ,

 ]);
 session()->flash('edit', 'تم تعديل المنتج بنجاح ');
 return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
// return "mohamed and rania ";
         $products=products::find($request->product_id)->delete();
         session()->flash('delete', 'تم حذف المنتح بنجاح ');
         return redirect('/products');
    }
}
