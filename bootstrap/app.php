<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\PreviewAccessMiddleware;
use Inertia\Inertia;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
        
        // Registriere die PreviewAccess-Middleware
        $middleware->alias([
            'preview.access' => PreviewAccessMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $e, $request) {
            return Inertia::render('Error', [
                'status' => method_exists($e, 'getStatusCode')
                    ? $e->getStatusCode()
                    : 500,
                'message' => $e->getMessage() ?: 'Server Error',
                'errorInfo' => [
                    'debug' => config('app.debug') ? [
                        'message' => $e->getMessage(),
                        'stack' => $e->getTraceAsString(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine()
                    ] : null
                ]
            ]);
        });
    })->create();
