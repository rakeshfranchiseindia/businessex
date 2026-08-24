<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    private const PROVIDERS = [
        'google' => 'google_id',
        'facebook' => 'facebook_id',
        'linkedin' => 'linkedin_id',
    ];

    public function redirect(string $provider): RedirectResponse
    {
        $this->ensureProviderIsSupported($provider);

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        $this->ensureProviderIsSupported($provider);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Throwable $exception) {
            report($exception);

            return redirect('/')->with('social_login_error', 'Unable to sign in with '.ucfirst($provider).'. Please try again.');
        }

        $providerColumn = self::PROVIDERS[$provider];
        $providerId = (string) $socialUser->getId();
        $user = UserAccount::where($providerColumn, $providerId)->first();

        if (!$user && $socialUser->getEmail()) {
            $user = UserAccount::where('email', $socialUser->getEmail())->first();
        }

        if (!$user && !$socialUser->getEmail()) {
            return redirect('/')->with('social_login_error', 'This social account did not provide an email address.');
        }

        if (!$user) {
            $user = UserAccount::create([
                'user_rand_id' => $this->uniqueUserRandId(),
                'name' => $socialUser->getName() ?: Str::before($socialUser->getEmail(), '@'),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(40)),
                'company_name' => '',
                'is_active' => 1,
                'reg_source' => 2,
                'reg_profile' => 'social',
                'profile_pic' => $socialUser->getAvatar(),
                $providerColumn => $providerId,
            ]);
        } else {
            $user->{$providerColumn} = $providerId;
            if (!$user->name && $socialUser->getName()) {
                $user->name = $socialUser->getName();
            }
            if (!$user->profile_pic && $socialUser->getAvatar()) {
                $user->profile_pic = $socialUser->getAvatar();
            }
            $user->save();
        }

        Auth::login($user, true);
        request()->session()->regenerate();

        return redirect('/dashboard/myaccount');
    }

    private function ensureProviderIsSupported(string $provider): void
    {
        abort_unless(array_key_exists($provider, self::PROVIDERS), 404);
    }

    private function uniqueUserRandId(): string
    {
        do {
            $userRandId = strtolower(Str::random(6));
        } while (UserAccount::where('user_rand_id', $userRandId)->exists());

        return $userRandId;
    }
}
