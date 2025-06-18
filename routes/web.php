<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\PreviewController;
use Inertia\Inertia;

// Routing je nach Status
if (config('app.env') === 'coming_soon') {
    // Coming-soon route
    Route::get('/', function () {
        // Wenn der Benutzer bereits angemeldet ist, direkt zur Hauptseite weiterleiten
        if (session('access_granted')) {
            return redirect()->route('home');
        }
        return view('coming-soon');
    })->name('coming.soon');

    // Route für die Passwortanmeldung
    Route::post('/preview-login', [PreviewController::class, 'login'])->name('preview.login');

    // Spezielle Route für die Startseite nach erfolgreicher Anmeldung
    Route::get('/home', [HomepageController::class, 'home'])
        ->middleware('preview.access')
        ->name('home');

    // Schütze alle anderen Routen mit der Middleware
    Route::middleware('preview.access')->group(function () {
        Route::get('/teams', [TeamController::class, 'index'])->name('teams');
        Route::get('/impressum', function () {
            return Inertia::render('Impressum');
        })->name('impressum');
        Route::get('/datenschutz', function () {
            return Inertia::render('Datenschutz');
        })->name('datenschutz');
        Route::post('/captcha/verify', [CaptchaController::class, 'verify'])->name('captcha.verify');
    });

    // Umleitung aller anderen Routen auf die Coming-Soon-Seite außer statische Assets
    Route::get('/{any}', function () {
        return view('coming-soon');
    })->where('any', '^(?!.*\.(css|js|jpg|jpeg|png|gif|ico|svg|ttf|woff|woff2|eot|pdf|webp)).*$');
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
    Route::post('/kontakt', [HomepageController::class, 'submitContactForm'])->name('contact.submit');
}
