<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PreviewController extends Controller
{
    /**
     * Das Passwort für den Zugriff auf die Vorschau-Version der Website
     * 
     * @var string
     */
    protected $previewPassword = 'svpolle2025';    /**
     * Verarbeitet die Anmeldeversuche für die Vorschau-Version
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $password = $request->input('password');

        if ($password === $this->previewPassword) {
            // Passwort ist korrekt, setze einen Session-Wert, um den Zugriff zu erlauben
            $request->session()->put('access_granted', true);
            $request->session()->save(); // Explizit speichern
            
            // Bei AJAX-Anfragen JSON-Antwort mit Redirect-URL senden, sonst direkt umleiten
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true, 
                    'redirect' => route('home')
                ]);
            }
            
            return redirect()->route('home');
        }

        // Passwort ist falsch, Fehlermeldung zurückgeben
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['error' => 'Das eingegebene Passwort ist falsch.']);
        }
        
        return redirect()->route('coming.soon')->with('error', 'Das eingegebene Passwort ist falsch.');
    }
}
