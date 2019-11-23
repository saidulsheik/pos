<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() ){
            $product=[];
            $products=Product::all();
            $categories=Category::all();
            $brands=Brand::all();
            return view('product.index', [
                'products'=>$products, 
                'product'=>$product, 
                'categories'=>$categories, 
                'brands'=>$brands]
            );
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $product = Product::create([
                'category_id' => $request->input('category_id'),
                'brand_id' => $request->input('brand_id'),
                'modelname'=>$request->input('modelname'),
                'productname'=>$request->input('productname'),
                'isserialised'=>$request->input('isserialised'),
            ]);
            if($product){
                return redirect()->route('product.index', ['product'=> $product->id])
                ->with('success' , 'Product created successfully');
            }
        }
        return back()->withInput()->with('errors', 'Error creating new Product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if( Auth::check() ){
            $products=Product::all();
            $categories=Category::all();
            $brands=Brand::all();
            $product=Product::find($product->id);
            return view('product.index',  ['products'=>$products, 'categories'=>$categories, 'brands'=>$brands, 'product'=>$product]);
        }
        return view('auth.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if( Auth::check() ){
            $productUpdate=Product::where('id', $product->id)->update([
                'category_id' => $request->input('category_id'),
                'brand_id' => $request->input('brand_id'),
                'modelname'=>$request->input('modelname'),
                'productname'=>$request->input('productname'),
                'isserialised'=>$request->input('isserialised'),
                'status'=>$request->input('status'),
            ]);
            if($productUpdate){
                return redirect()->route('product.index', ['product'=>$product->id])
                ->with('success' , "Product Updated successfully");
            }
        }
        return view('auth.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
