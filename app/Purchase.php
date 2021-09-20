<?php

namespace App;
use App\User;
use App\Provider;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'provider_id',
        'user_id',
        'purchases_date',
        'tax',
        'total',
        'factura'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
