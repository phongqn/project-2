<?php

namespace App\Models;

use App\Enums\PayMentMethodEnum;
use App\Enums\StatusOrderEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'total_price',
        'quantity',
        'phone',
        'email',
        'address',
        'type',
        'payment_method',
        'status',
        'country',
        'note',
        'discount_id',
        'city',
        'district',
        'price_ship'
    ];
    protected $appends = ['payment_name', 'status_name'];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getPaymentNameAttribute()
    {
        return PayMentMethodEnum::getName($this->payment_method);
    }
    public function getStatusNameAttribute()
    {
        return StatusOrderEnum::getName($this->status);
    }
}
