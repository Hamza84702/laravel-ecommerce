<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCheckout extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'cart_id',
        'delivery_address'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,  'user_id','id');
    }
}
