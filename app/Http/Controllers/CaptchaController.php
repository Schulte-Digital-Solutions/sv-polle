<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CaptchaController extends Controller
{
    public function verify(Request $request)
    {
        $token = $request->input('token');

        $response = Http::asForm()->post('https://hcaptcha.com/siteverify', [
            'secret' => config('services.hcaptcha.secret'),
            'response' => $token
        ]);

        if ($response->successful() && $response->json('success')) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
