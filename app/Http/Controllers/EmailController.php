<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

use App\Models\User;

class EmailController extends Controller
{

    public function verify($token)
    {
        $user = User::where('email_verification_token', $token)->firstOrFail();
        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();

        Redis::del("timer_{$user->id}_email_verification_token");

        return Inertia::render('email/EmailVerified', [
            'message' => 'Электронная почта успешно подтверждена!',
        ]);
    }

    public function Sendverify()
    {
        $user = auth()->user();
        $timerKey = "timer_{$user->id}_email_verification_token";


        if (Redis::get($timerKey) && (Redis::get($timerKey) - time()) > 0) {
            return response()->json(['message' => 'Письмо можно отправить раз в 15 минут.']);
        }

        if ($user->email_verification_token == null) {
            $user->email_verification_token = Str::random(75);
            $user->save();
        }

        if (Mail::to($user->email)->send(new VerifyEmail($user))) {
            $message = 'Письмо было отправленно.';
            Redis::set($timerKey, time() + 60 * 15);

        } else {
            $message = 'Что-то пошло не так.';
        }

        return response()->json(['message' => $message]);
    }

}
