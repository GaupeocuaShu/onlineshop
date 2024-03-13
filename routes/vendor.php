<?php

use App\Http\Controllers\Vendor\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\ShopProfileController;
// Profile -------------------------------------------------
Route::post("profile-update",[ProfileController::class,"profileUpdate"])->name("profile-update");

Route::post("password-update",[ProfileController::class,"passwordUpdate"])->name("password-update");

Route::get("profile",[ProfileController::class,"index"])->name("profile");
// Profile -------------------------------------------------


// Shop Profile -------------------------------------------------

Route::resource("shop-profile", ShopProfileController::class);

// Shop Profile -------------------------------------------------
