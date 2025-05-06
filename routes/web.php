<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CaptchaController;
use Inertia\Inertia;

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
    Route::get('/teams', [TeamController::class, 'index'])->name('teams');
    Route::get('/impressum', function () {
        return Inertia::render('Impressum');
    })->name('impressum');
    Route::get('/datenschutz', function () {
        return Inertia::render('Datenschutz');
    })->name('datenschutz');
    Route::post('/captcha/verify', [CaptchaController::class, 'verify'])->name('captcha.verify');
}
