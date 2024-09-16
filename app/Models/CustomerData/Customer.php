<?php

namespace App\Models\CustomerData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'phone_number'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
