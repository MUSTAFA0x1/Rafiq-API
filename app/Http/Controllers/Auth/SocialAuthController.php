<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $fullName = $googleUser->getName();
        $splitName = explode(' ', $fullName, 2);

        $firstName = $splitName[0];
        $lastName = isset($splitName[1]) ? $splitName[1] : '';

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'uuid' => Str::uuid(),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'password' => bcrypt(Str::random(24)), // Random since not used
            ]
        );

        // Generate JWT token (using tymon/jwt-auth)
        $token = auth()->login($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
            'expires_in' => auth()->factory()->getTTL() * 21600
        ]);
    }
}
