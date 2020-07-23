<?php

namespace App\Hail\Socialite;

use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;

class HailProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * The scopes being requested.
     * 
     * @var array
     */
    protected $scopes = [
        'user.basic',
        'content.read'
    ];

    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * The url for the authentication provider.
     * 
     * @var string
     */
    const BASE_URL = 'https://hail.to/api/v1';

    /**
     * Get the authentication URL for the provider.
     *
     * @param  string  $state
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://hail.to/oauth/authorise', $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return 'https://hail.to/api/v1/oauth/access_token';
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string  $token
     * @return array
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(self::BASE_URL . '/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param  array  $user
     * @return \Laravel\Socialite\Two\User
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'avatar_url' => $user['avatar_url'],
        ]);
    }

    /**
     * Get the POST fields for the request.
     * 
     * @param string $code
     * 
     * @return array
     */
    protected function getTokenFields($code)
    {
        return parent::getTokenFields($code) + [
            'grant_type' => 'authorization_code'
        ];
    }
}