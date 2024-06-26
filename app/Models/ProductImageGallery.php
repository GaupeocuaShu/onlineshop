<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImageGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_id", "image","name"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
