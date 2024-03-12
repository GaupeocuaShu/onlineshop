<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddresses extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "name",
        "type",
        "email",
        "phone",
        "country",
        "state",
        "city",
        "zip",
        "address",
    ];
}
