<?php

namespace App\Services;

use App\Exceptions\DiscordServiceException;
use App\Models\AllowedRole;
use Laravel\Socialite\Contracts\User;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;

class DiscordService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $botToken;

    /**
     * @var string
     */
    protected $guildId;

    /**
     * DiscordWebhookService constructor.
     *
     * @param string $discordBaseUri
     * @param string $clientId
     * @param string $botToken
     * @param string $guildId
     */
    public function __construct(string $discordBaseUri, string $clientId, string $botToken, string $guildId)
    {
        $this->client = new Client([
            'base_uri' => "$discordBaseUri",
        ]);

        $this->clientId = $clientId;
        $this->botToken = $botToken;
        $this->guildId = $guildId;
    }

    /**
     * Returns whether the given user is part of the current Discord guild or not.
     *
     * @param User|\App\Models\User|\Illuminate\Contracts\Auth\Authenticatable $user
     *
     * @return bool
     *
     * @throws DiscordServiceException
     */
    public function isUserAllowedToLogin($user) : bool
    {
        $id = ($user instanceof User) ? $user->id : $user->discord_id;

        $response = $this->request('GET', "guilds/{$this->guildId}/members/$id", [
            'headers' => [
                'Authorization' => "Bot {$this->botToken}",
            ]
        ]);

        if (!empty($response['user'])) {
            if ($id === $response['user']['id']) {
                $roles = AllowedRole::whereIn('role_id', $response['roles'])->get();

                if (!$roles->isEmpty()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Return a list of guild roles.
     *
     * @return array
     *
     * @throws DiscordServiceException
     */
    public function getGuildRoles() : array
    {
        return $this->request('GET', "guilds/{$this->guildId}/roles", [
            'headers' => [
                'Authorization' => "Bot {$this->botToken}",
            ]
        ]);
    }

    /**
     * Create a request.
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @return array
     *
     * @throws DiscordServiceException
     */
    public function request(string $method, string $uri, array $options = []) : array
    {
        try {
            $response = $this->client->request($method, $uri, $options);

            $statusCode = $response->getStatusCode();
            if ($statusCode === Response::HTTP_OK
                || $statusCode === Response::HTTP_CREATED
                || $statusCode === Response::HTTP_ACCEPTED
                || $statusCode === Response::HTTP_NO_CONTENT
                || $statusCode === Response::HTTP_PARTIAL_CONTENT
                || $statusCode === Response::HTTP_FOUND
                || $statusCode === Response::HTTP_NOT_FOUND
            ) {
                return json_decode($response->getBody()->getContents(), true);
            } else {
                throw new DiscordServiceException($response->getBody()->getContents(), $response->getStatusCode());
            }
        } catch (GuzzleException $exception) {
            throw new DiscordServiceException($exception->getMessage(), $exception->getCode());
        } catch (\Exception $e) {
            throw new DiscordServiceException($e->getMessage(), $e->getCode());
        }
    }
}
