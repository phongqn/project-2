<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discounts';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'code',
        'price',
        'begin',
        'end'
    ];
}
