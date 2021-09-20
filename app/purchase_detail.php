<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase_detail extends Model
{
    protected  $fillable= [
        'shopping_id',
        'product_id',
        'quantity',
        'price'
    ];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
