<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class TeamController extends Controller
{
    public function index()
    {
        // Team id's
        $teams = [
            'Erste Mannschaft' => "2w3Vh5TVf5ubMw0D10x6TgJwcEP",
            'Zweite Mannschaft' => "2wQ6InGs5RDeeMONgYsfdS08XwF",
            'Frauen Mannschaft' => "2wQ6lTlSfeXzQSmsbaoIr6fB05m",
        ];
        return Inertia::render('Teams', ['teams' => $teams]);
    }

    public function dart()
    {
        return Inertia::render('DartTeams');
    }
}
