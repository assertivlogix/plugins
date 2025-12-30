<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;

class SupportController extends Controller
{
    public function index()
    {
        return view('support.index');
    }

    public function documentation()
    {
        return view('support.documentation');
    }

    public function contact()
    {
        return view('support.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            // Send email to sales team
            Mail::to('sales@assertivlogix.com')->send(new ContactFormSubmission(
                $request->name,
                $request->email,
                $request->subject,
                $request->message
            ));

            return redirect()->route('support.contact')
                ->with('success', 'Thank you for contacting us! We will get back to you as soon as possible.');
        } catch (\Exception $e) {
            \Log::error('Failed to send contact form email', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return redirect()->route('support.contact')
                ->with('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }

    public function forum()
    {
        return view('support.forum');
    }
}
