<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;


// Routing je nach Status
if (env('APP_ENV', 'production') === 'coming_soon') {
    Route::get('/', function () {
        return view('coming-soon');
    })->name('coming-soon');
    // redirect all other routes to the coming soon page
    Route::get('/{any}', function () {
        return view('coming-soon');
    })->where('any', '.*');
} else {
    Route::get('/', [HomepageController::class, 'home'])->name('home');
}
