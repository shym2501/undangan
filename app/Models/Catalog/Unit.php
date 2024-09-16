<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Catalog\Products;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $guarded = [];
    protected $fillable = [
        'name',
        'alias',
        'slug'
    ];

    public function Product(): HasOne
    {
        return $this->hasOne(Products::class, 'unit_id', 'id');
    }
}
