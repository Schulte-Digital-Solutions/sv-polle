<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;

Route::get('/', [HomepageController::class, 'home'])->name('home');
