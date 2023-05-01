<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'descipition',
        'status',
        'is_selling',
        'is_outstanding',
        'category_id',
        'supplier_id',
        'brand_id'
    ];
    protected $appends = ['quantity'];
    public function getQuantityAttribute()
    {
        $totalQuantity = array_sum(array_column(ProductSize::where('product_size.product_id', $this->id)
            ->join('product_color', 'product_color.product_size_id', 'product_size.id')
            ->get('quantity')->toArray(), 'quantity'));
        return $totalQuantity;
    }
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
    public function Brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function ProductSize()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'id'); //->with('Img', 'ProductColor'); //->whereHas('ProductColor');
    }
}
