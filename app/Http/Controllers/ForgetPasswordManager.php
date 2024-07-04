<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\MyEmail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ForgetPasswordManager extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $token = Str::random(60);
        $email = $request->input('email');

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]
        );

        $queryParams = http_build_query([
            'token' => $token,
        ]);

        $resetLink = 'https://c448-169-150-218-130.ngrok-free.app/Resetpassword?' . $queryParams;

        $mailData = [
            'title' => 'Password Reset Request',
            'body' => "$resetLink",
        ];

        Mail::to($email)->send(new MyEmail($mailData));

        return response()->json(['message' => 'Password reset email sent successfully!']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->input('email'))
            ->where('token', $request->input('token'))
            ->first();

        if (!$tokenData) {
            return response()->json(['message' => 'Invalid token or email!'], 400);
        }

        // Update user password
        $user = User::where('email', $request->input('email'))->first();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Delete the token after successful reset
        DB::table('password_reset_tokens')->where('email', $request->input('email'))->delete();

        return response()->json(['message' => 'Password reset successfully!']);
    }
}
