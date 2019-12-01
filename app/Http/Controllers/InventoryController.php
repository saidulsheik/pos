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
            $inventories=Inventory::all();
            $products=Product::all();
            return view('inventory.index',[
                'inventory'=>$inventory,
                'inventories'=>$inventories,
                'products'=>$products,
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
        $inventories=Inventory::all();
        $products=Product::all();
        $inven=[
            'id' => '',
            'product_id' => $request->input('product_id'),
            'supplier_name' => $request->input('supplier_name'),
            'buyprice' => $request->input('buyprice'),
            'saleprice' => $request->input('saleprice'),
            'serial' => '',
        ];
      
        return view('inventory.index',[
            'inven'=>$inven,
            'inventories'=>$inventories,
            'products'=>$products,
        ]);
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
