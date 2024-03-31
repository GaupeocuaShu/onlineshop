<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    public $fillable = [
        "order_id",
        "product_id",
        "vendor_id",
        "product_name",
        "variants",
        "variant_total",
        "unit_price",
        "qty",
    ];
}
