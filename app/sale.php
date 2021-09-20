<?php

namespace App;

use App\sale_detail;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    protected $fillable=[
        'CodFact',
        'user_id',
        'sale_date',
        'total',
        'tax',
        'datap',
        'status'
    ];

    public function saledetails()
    {
        return $this->hasMany(sale_detail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
