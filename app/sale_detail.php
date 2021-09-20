<?php

namespace App;

use App\sale;
use Illuminate\Database\Eloquent\Model;

class sale_detail extends Model
{
    protected $fillable=[
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'discount'
    ];

    public function sale(){

        return $this->belongsTo(sale::class);
}

}
