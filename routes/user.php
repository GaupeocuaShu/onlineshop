<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\ProfileController;

// Profile -------------------------------------------------

Route::post("update-profile",[ProfileController::class,"updateProfile"])->name("update-profile");
Route::get("profile",[ProfileController::class,"index"])->name("profile");
// Profile -------------------------------------------------

