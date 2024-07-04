<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Mail\MyEmail;
use Illuminate\Support\Facades\Mail;
class MailController extends Controller
{
    public function sendEmail()
    {
        $mailData = [
            'title' => 'Test Email',
            'body' => 'This is a test email sent by Laravel.',
        ];
        Mail::to('ahmadhajnajeeb45@gmail.com')->send(new MyEmail($mailData));

        return response()->json(['message' => 'Email sent successfully!']);
    }
}