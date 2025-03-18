<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomepageController extends Controller
{
    public function home()
    {
        return Inertia::render('Homepage');
    }
}
