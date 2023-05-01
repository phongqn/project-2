<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountUser extends Model
{
    use HasFactory;
    protected $table = 'discount_user';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'discount_id',
        'status'
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function Discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
}
