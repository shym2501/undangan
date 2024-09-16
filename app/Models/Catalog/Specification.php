<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Catalog\Products;

class Specification extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'name',
        'value',
    ];

    public function Product(): HasMany
    {
        return $this->hasMany(Products::class, 'specification_id', 'id');
    }
}
