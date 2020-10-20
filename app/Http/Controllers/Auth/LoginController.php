<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\DiscordServiceException;
use App\Http\Controllers\Controller;
use App\Services\DiscordService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Team;

class LoginController extends Controller
{
    protected $discordService;

    /**
     * LoginController constructor.
     *
     * @param DiscordService $discordService
     */
    public function __construct(DiscordService $discordService)
    {
        $this->discordService = $discordService;
    }

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
     *
     * @throws DiscordServiceException
     */
    public function handleDiscordCallback()
    {
        $user = Socialite::driver('discord')->user();

        if (!$this->discordService->isUserAllowedToLogin($user)) {
            return redirect('/')->withErrors(['message' => __('Login unauthorized.')]);
        }

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
