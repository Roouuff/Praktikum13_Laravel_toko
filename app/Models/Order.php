<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status'];

    /**
     * Relasi: Order dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Order memiliki banyak OrderItem (One to Many)
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}