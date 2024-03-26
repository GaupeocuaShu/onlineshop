<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\ProfileController;

// Profile -------------------------------------------------
Route::post("update-password",[ProfileController::class,"updatePassword"])->name("update-password");
Route::post("update-profile",[ProfileController::class,"updateProfile"])->name("update-profile");
Route::get("profile",[ProfileController::class,"index"])->name("profile");
// Profile -------------------------------------------------

// Cart  
Route::put("/cart",[CartController::class,"update"])->name("cart.update");
Route::get("/cart/get",[CartController::class,"get"])->name("cart.get");
Route::get("/cart",[CartController::class,"index"])->name("cart");