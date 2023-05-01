<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'district',
        'country',
        'account_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'account_id', 'id');
    }
}
