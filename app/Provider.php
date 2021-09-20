<?php

namespace App;

use App\Product;
use App\Purchase;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable=[
        'name',
        'phone',
        'email'
    ];
    protected $hidden = ['created_at', 'updated_at'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }

    public function scopeFprovider($query,$filtro){
        if(!empty($filtro)){
            $query->where('name','LIKE','%'.$filtro.'%')
        ->orwhere('email','LIKE','%'.$filtro.'%');
        }

    }


}
