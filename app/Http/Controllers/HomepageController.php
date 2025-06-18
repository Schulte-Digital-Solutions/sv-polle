<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Mail\ContactFormMail;

class HomepageController extends Controller
{
    public function home()
    {
        return Inertia::render('Homepage');
    }

    /**
     * Handle the contact form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
            'privacy' => 'required|in:1,true,on,yes'
        ]);

        Mail::to(config('mail.from.address'))->send(
            new ContactFormMail(
                $request->name,
                $request->email,
                $request->message
            )
        );

        // Wenn es eine Inertia-Anfrage ist, setzen wir die Flash-Message in der Session
        if ($request->wantsJson()) {
            session()->flash('success', 'Vielen Dank für Ihre Nachricht!');
            return back();
        }

        return redirect()->route('home')->with('success', 'Vielen Dank für Ihre Nachricht!');
    }
}
