<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $table = 'product_color';

    protected $fillable = [
        'product_size_id',
        'color_id',
        'quantity',
    ];
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }

    public function Color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function ProductSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id', 'id')->with(['Product', 'Img']);
    }
    
    public function Product()
    {
        return $this->hasManyThrough(Product::class, ProductSize::class, 'id', 'id', 'product_size_id', 'product_id');
    }
}
