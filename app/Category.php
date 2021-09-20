<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable =[
        'name',
        'description'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeFcategory($query,$filtro){
        if(!empty($filtro)){
            $query->where('name','LIKE','%'.$filtro.'%')
        ->orwhere('description','LIKE','%'.$filtro.'%');
        }

    }

}
