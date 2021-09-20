<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    protected $fillable=[
        'url',
        'status',
        'user_id'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
