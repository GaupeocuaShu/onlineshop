<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
// User -------------------------------------------------

Route::resource('user', UserController::class);

// User -------------------------------------------------

