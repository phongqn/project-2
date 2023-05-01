<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
    ];
    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    protected $appends = ['quantity'];


    public function getQuantityAttribute()
    {
        $totalQuantity = array_sum(array_column(Product::where('category_id', $this->id)->get()->toArray(), 'quantity'));
        return $totalQuantity;
    }
}
