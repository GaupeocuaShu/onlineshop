<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\CheckOutController;
use App\Http\Controllers\User\ProfileController;

// Profile -------------------------------------------------
Route::post("update-password",[ProfileController::class,"updatePassword"])->name("update-password");
Route::post("update-profile",[ProfileController::class,"updateProfile"])->name("update-profile");
Route::get("profile",[ProfileController::class,"index"])->name("profile");
// Profile -------------------------------------------------

// Cart   -------------------------------------------------
Route::delete("/{id}/cart",[CartController::class,"delete"])->name("cart.delete");
Route::put("/cart",[CartController::class,"update"])->name("cart.update");
Route::get("/cart/get",[CartController::class,"get"])->name("cart.get");
Route::get("/cart",[CartController::class,"index"])->name("cart");
// Add to cart 
Route::post("/add-to-cart",[CartController::class,"addToCart"])->name("add-to-cart");
// apply coupon 
Route::put("/apply-coupon",[CartController::class,"applyCoupon"])->name("apply-coupon");

// Cart   ------------------------------------------------- 


// Check out   ------------------------------------------------- 
Route::get("/check-out",[CheckOutController::class,"index"])->name("check-out");
// Check out   ------------------------------------------------- 

// Address ------------------------------------------------- 

Route::resource("address",AddressController::class);

// Address ------------------------------------------------- 
