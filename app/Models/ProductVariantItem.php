<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantItem extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "status", "price", "is_default", "product_variant_id",
    ];
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
