<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];
    public function ProductColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_id', 'id')->with('ProductSize');
    }
    public function ProductSize()
    {
        return $this->hasManyThrough(ProductSize::class, ProductColor::class, 'id', 'id', 'product_id', 'product_size_id');
    }
}
