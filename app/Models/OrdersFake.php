<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersFake extends Model
{
    use HasFactory;

    protected $table = 'orders_fake'; // Ensure this matches the actual table name

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'status',
    ];

    public $timestamps = false;

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
