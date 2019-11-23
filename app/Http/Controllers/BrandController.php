<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() ){
            $brand=[];
            $brands=Brand::all();
            return view('brand.index', ['brands'=>$brands, 'brand'=>$brand]);
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
            $brand = Brand::create([
                'name' => $request->input('name'),
            ]);
            if($brand){
                return redirect()->route('brand.index', ['brand'=> $brand->id])
                ->with('success' , 'Brand created successfully');
            }
        }
        return view('auth.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        if( Auth::check() ){
            $brands=Brand::all();
            $brand=Brand::find($brand->id);
            return view('brand.index', ['brands'=>$brands, 'brand'=>$brand]);
        }
        return view('auth.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        if( Auth::check() ){
            $brandUpdate=brand::where('id', $brand->id)->update([
                'name'=>$request->input('name'),
            ]);
            if($brandUpdate){
            // return redirect('brand.index',['brand']=>$brand->id)
                return redirect()->route('brand.index', ['brand'=>$brand->id])
                ->with('success' , "brand Updated successfully");
            }
        }
        return view('auth.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
