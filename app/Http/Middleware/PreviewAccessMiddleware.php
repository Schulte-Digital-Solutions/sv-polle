<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreviewAccessMiddleware
{
    /**
     * Überprüfe, ob der Benutzer Zugriff auf die Vorschau-Version hat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Debug-Ausgabe für Fehlerbehebung
        \Log::debug('PreviewAccessMiddleware aufgerufen');
        \Log::debug('Session-Status: ' . ($request->session()->has('access_granted') ? 'Zugriff gewährt' : 'Kein Zugriff'));
        
        // Überprüfe, ob der Benutzer die erforderliche Session-Variable hat
        if (!$request->session()->has('access_granted')) {
            \Log::debug('Zugriff verweigert, Umleitung zur Coming-Soon-Seite');
            return redirect()->route('coming.soon');
        }

        \Log::debug('Zugriff gewährt, Anfrage wird fortgesetzt');
        return $next($request);
    }
}
