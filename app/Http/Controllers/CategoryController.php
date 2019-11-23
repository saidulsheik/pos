<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if( Auth::check() ){
            $category=[];
            $categories=Category::all();
            return view('category.index', ['categories'=>$categories, 'category'=>$category]);
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
            $category = Category::create([
                'name' => $request->input('name'),
            ]);
            if($category){
                return redirect()->route('category.index', ['category'=> $category->id])
                ->with('success' , 'Category created successfully');
            }
        }
        return view('auth.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if( Auth::check() ){
            $categories=Category::all();
            $category=Category::find($category->id);
            return view('category.index', ['categories'=>$categories, 'category'=>$category]);
        }
        return view('auth.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if( Auth::check() ){
            $categoryUpdate=Category::where('id', $category->id)->update([
                'name'=>$request->input('name'),
            ]);
            if($categoryUpdate){
            // return redirect('category.index',['category']=>$category->id)
                return redirect()->route('category.index', ['category'=>$category->id])
                ->with('success' , "Category Updated successfully");
            }
        }
        return view('auth.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
