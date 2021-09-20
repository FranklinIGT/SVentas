<?php

namespace App;

use App\image;
use App\Category;
use App\Provider;
use App\sale_detail;
use App\purchase_detail;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'price',
        'status',
        'category_id',
        'providers_id'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider( )
    {
        return $this->belongsTo(Provider::class);
    }
    public function sales_details()
    {
        return $this->hasMany(sale_detail::class);
    }
    public function purchase_details()
    {
        return $this->hasMany(purchase_detail::class);
    }
    public function images()
    {
        return $this->hasMany(image::class);
    }

    public function scopeFproduct($query,$filtro){
        if(!empty($filtro)){
            $query->join('categories','categories.id',"=",'products.category_id')
            ->join('providers','providers.id',"=",'products.providers_id')
            ->select(
            "products.id",
            "products.name" ,
            "products.stock",
            "products.price",
            "products.status",
            "categories.name as categorie_name",
            "providers.name as providers_name",
            )-> where('products.name','LIKE','%'.$filtro.'%')
            ->orwhere('id','LIKE','%'.$filtro.'%');


        }
    }
}
