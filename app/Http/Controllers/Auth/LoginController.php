<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Team;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToDiscord()
    {
        return Socialite::driver('discord')->redirect();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleDiscordCallback()
    {
        $user = Socialite::driver('discord')->user();
        $foundUser = User::where('discord_id', $user->id)->first();

        if ($foundUser) {
            $foundUser->avatar = $user->getAvatar();
            $foundUser->name = $user->getName();
            $foundUser->email = $user->getEmail();
            $foundUser->nickname = $user->getNickname();
            $foundUser->save();

            Auth::login($foundUser);
            return redirect('/dashboard');
        } else {
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'discord_id' => $user->getId(),
                'avatar' => $user->getAvatar(),
                'nickname' => $user->getNickname(),
            ]);

            // Create the administrator team if none is found.
            if (Team::all()->count() === 0) {
                $newTeam = Team::forceCreate([
                    'user_id' => $newUser->id,
                    'name' => "Administrators",
                    'personal_team' => false,
                ]);

                $newTeam->save();

                $newUser->current_team_id = $newTeam->id;
            }

            $newUser->save();

            Auth::login($newUser);

            return redirect('/dashboard');
        }
    }
}
