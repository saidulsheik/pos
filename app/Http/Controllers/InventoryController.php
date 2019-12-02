<?php

namespace App\Http\Controllers;

use App\Model\Inventory;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() ){
            $inventory=[];
            $inven=[];
            $inventories=Inventory::all();
            $products=Product::all();
            return view('inventory.index',[
                'inventory'=>$inventory,
                'inventories'=>$inventories,
                'products'=>$products,
                 'inven'=>$inven,
            ]);
        }
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

            $request->validate([
                'serial' => 'unique:inventories'
            ]);

            $inventories=Inventory::all();
            $products=Product::all();
            $inven=[
                'product_id' => $request->input('product_id'),
                'supplier_name' => $request->input('supplier_name'),
                'buyprice' => $request->input('buyprice'),
                'saleprice' => $request->input('saleprice'),
            ];
            $storeinventory = Inventory::create([
                'product_id' => $request->input('product_id'),
                'supplier_name' => $request->input('supplier_name'),
                'buyprice' => $request->input('buyprice'),
                'saleprice' => $request->input('saleprice'),
                'serial' => $request->input('serial'),
                'buydate' => date("Y-m-d"),
                'quantity' => 1,
            ]);
            if($storeinventory){
                return view('inventory.index', [
                    'inventoryid'=> $storeinventory->id,
                    'inven'=>$inven,
                    'inventories'=>$inventories,
                    'products'=>$products,
                    'success'=> 'Product Added successfully',
                    ]);
            }
        }
        return back()->withInput()->with('errors', 'Error creating new Product');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
