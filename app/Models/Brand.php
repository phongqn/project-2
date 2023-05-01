<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = [
        'name',
    ];
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
    protected $appends = ['quantity'];
    public function getQuantityAttribute()
    {
        $totalQuantity = array_sum(array_column(Product::where('brand_id', $this->id)->get()->toArray(), 'quantity'));
        return $totalQuantity;
    }
}
