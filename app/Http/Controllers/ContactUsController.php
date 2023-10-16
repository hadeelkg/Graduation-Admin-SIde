<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactUsController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);


        // Send the email
        Mail::raw($validatedData['message'], function ($message) use ($validatedData) {
            $message->to('clientEmail@gmail.com')
                ->subject('New contact form submission')
                ->from($validatedData['email'], $validatedData['name'], $validatedData['message']);
        });

        // Return a JSON response indicating success
        return response()->json(['message' => 'Email sent successfully']);
    }


}

