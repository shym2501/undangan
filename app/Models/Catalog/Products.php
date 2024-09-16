<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Unit;
use App\Models\Catalog\Specification;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'image',
        'buying_price',
        'sale_price',
        'discount',
        'category_id',
        'brand_id',
        'unit_id',
        'specification_id',
        'varian_id',
        'qty',
        'is_visible',
    ];
    public function category() : BelongsTo {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function brand() : BelongsTo {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function unit() : BelongsTo {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function specification() : BelongsToMany {
        return $this->belongsToMany(Specification::class, 'specification_id', 'id');
    }
}


