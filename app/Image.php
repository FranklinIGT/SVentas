<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected  $fillable=[
       'url',
       'status',
       'product_id'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
