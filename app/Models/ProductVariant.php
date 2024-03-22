<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable  = [
        "name", "product_id", "status",
    ];
    public function product_variant_item()
    {
        return $this->hasMany(ProductVariantItem::class);
    }
}
