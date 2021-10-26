<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SteamApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function auth($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    public function callback(SteamApiService $steamApiService, $provider)
    {

        $result = Socialite::driver($provider)->user();
        $isset = User::where('provider_uid', $result->getId())->first();
        $writeMessage = false;
        if ($isset) {
            $user = Auth::loginUsingId($isset->id);
            $user->name = $result->getNickname();
            $user->slug = $result->getNickname();
            $user->img = $steamApiService->getUserAvatar($result->getId());
            $user->save();
            $writeMessage = true;
        } else {
            $user = User::create([
                'slug' => $result->getNickname(),
                'name' => $result->getNickname(),
                'email' => $result->getEmail(),
                'provider' => 'steam',
                'provider_uid' => $result->getId(),
                'img' => $steamApiService->getUserAvatar($result->getId()),
                'password' => '',
            ]);
            $user->setRole('user');
            $user->balance = 0.25;
            $user->save();
            Auth::loginUsingId($user->id);
        }
        if ($writeMessage) {
            return redirect()->route('home', ['writeMessage' => true]);
        }
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function loginAs($id)
    {
        if (Auth::check() && Auth::user() && Auth::user()->role_id == 1) {
            Auth::loginUsingId($id);
            return redirect()->home();
        }
        return redirect()->home();
    }
}
