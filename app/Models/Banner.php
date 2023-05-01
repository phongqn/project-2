<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';

    protected $fillable = [
        'name',
        'index',
        'status'
    ];
    public function Img()
    {
        return $this->morphMany(Image::class, 'object', 'type');
    }
}
