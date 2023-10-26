<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        // Các trường khác nếu cần
    ];

    // Định nghĩa mối quan hệ với bảng sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Định nghĩa mối quan hệ với bảng đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
