<?php

namespace App\Auth;

use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class VATSIMUKProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * Get the authentication URL for the provider.
     *
     * @param  string  $state
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(config('services.vatsim_uk_core.sso_base').'/oauth/authorize', $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return config('services.vatsim_uk_core.sso_base').'/oauth/token';
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string  $token
     * @return array
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(config('services.vatsim_uk_core.sso_base').'/api/user', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return (array) json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param  array  $user
     * @return \Laravel\Socialite\Two\User
     */
    protected function mapUserToObject(array $user)
    {
        $data = Arr::get($user, 'data', []);

        return (new User())->setRaw($data)->map([
            'id'       => $data['cid'],
            'name'     => $data['name_full'],
            'email'    => $data['email'],
            'first_name' => $data['name_first'],
            'last_name' => $data['name_last'],
        ]);
    }
}
