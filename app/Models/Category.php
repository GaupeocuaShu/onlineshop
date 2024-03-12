<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $fillable = [
        "icon","image", "name", "status", "slug",
    ];
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
