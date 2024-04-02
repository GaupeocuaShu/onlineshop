<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\CheckOutController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserMessageController;

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
Route::post("/check-out",[PaymentController::class,"store"])->name("check-out");
Route::get("/check-out",[CheckOutController::class,"index"])->name("check-out"); 
// Check out   ------------------------------------------------- 

// Address ------------------------------------------------- 
Route::put("/address/{id}/set-default",[AddressController::class,"setDefault"])->name("address.set-default");
Route::get("/address/get",[AddressController::class,"get"])->name("address.get");
Route::resource("address",AddressController::class);

// Address ------------------------------------------------- 



// Chat ------------------------------------------------- 
Route::post("message/send-message",[UserMessageController::class,'sendMessage'])->name("message.send-message");
Route::get('message/get-message',[UserMessageController::class,"getMessage"])->name("message.get-message");
// Chat ------------------------------------------------- 

