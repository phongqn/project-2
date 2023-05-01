<?php

namespace App\Models;

use App\Enums\TypeImgEnum;
use App\Enums\TypeSizeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $table = 'product_size';

    protected $fillable = [
        'product_id',
        'size',
        'price_sell',
        'price_import',
        'type_size',
    ];
    protected $appends = ['name_size'];
    public function getNameSizeAttribute()
    {
        $nameSize = TypeSizeEnum::getName($this->type_size);
        return $nameSize;
    }
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
    public function ProductColor()
    {
        return $this->hasMany(ProductColor::class, 'product_size_id', 'id')->with('Color');
    }
    public function Color()
    {
        return $this->hasManyThrough(Color::class, ProductColor::class, 'product_size_id', 'id', 'id', 'color_id');
    }
    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function Thums()
    {
        return Image::where('object_id', $this->id)->where('type', TypeImgEnum::PRODUCTSIZE_IMG)->first();
    }
}
