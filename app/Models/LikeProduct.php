<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeProduct extends Model
{
    use HasFactory;
    protected $table = 'like_product';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'product_id',
        'status'
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->with('Img', 'ProductSize');
    }

    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
}
