<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Log;

class SocialAuthController extends Controller
{
    public function handleGoogleCallback()
    {
        try {
            // Use stateless in local/dev (remove in production)
            $googleUser = Socialite::driver('google')
                ->user();

            // Find existing user by email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::login($user);
                return redirect()->intended('/');
            }

            // Create new user
            $user = User::create([
                'name'     => $googleUser->getName(),
                'email'    => $googleUser->getEmail(),
                'password' => Hash::make(uniqid()), // secure random password
                // Optional fields
                // 'google_id' => $googleUser->getId(),
                // 'avatar'    => $googleUser->getAvatar(),
            ]);

            Auth::login($user);

            return redirect()->intended('/');

        } catch (InvalidStateException $e) {
            return redirect('/login')
                ->with('error', 'Google login failed. Invalid session state. Please try again.');
        } catch (\Exception $e) {
            \Log::error('Google login error: ' . $e->getMessage());
            return redirect('/login')
                ->with('error', 'Unable to sign in with Google. Please try again later.');
        }
    }
}
