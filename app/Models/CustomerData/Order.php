<?php

namespace App\Models\CustomerData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'theme_id', 'status', 'total_price', 'payment_method_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
