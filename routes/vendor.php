<?php

use App\Http\Controllers\Vendor\ProfileController;
use Illuminate\Support\Facades\Route;

// Profile -------------------------------------------------
Route::post("profile-update",[ProfileController::class,"profileUpdate"])->name("profile-update");

Route::post("password-update",[ProfileController::class,"passwordUpdate"])->name("password-update");

Route::get("profile",[ProfileController::class,"index"])->name("profile");
// Profile -------------------------------------------------