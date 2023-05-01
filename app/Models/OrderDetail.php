<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];
    public function ProductSize()
    {
        return $this->hasManyThrough(ProductSize::class, ProductColor::class, 'id', 'id', 'product_id', 'product_size_id');
    }
}
