<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\ProfileController;

// Profile -------------------------------------------------


Route::get("profile",[ProfileController::class,"index"])->name("profile");
// Profile -------------------------------------------------

