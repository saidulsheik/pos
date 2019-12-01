<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'buyprice',
        'saleprice',
        'serial',
        'supplier_name',
        'buydate',
        'quantity',
    ];

    // public function brand(){
    //     return $this->belongsTo(Brand::class);
    // }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
