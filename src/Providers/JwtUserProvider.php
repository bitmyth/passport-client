<?php
/**
 * Created by PhpStorm.
 * User: gsh
 * Date: 2018/11/6
 * Time: 10:34 PM
 */

namespace Bitmyth\PassportClient\Providers;


use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Log;

class JwtUserProvider implements UserProvider
{

    private $httpClient;
    private $token;

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'http://account.qinbizi.com'
        ]);
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $url = '/oauth/token';
        $response = $this->httpClient->post($url, [
            'allow_redirects' => false,
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => config('oauth.client_credentials.client_id'),
                'client_secret' => config('oauth.client_credentials.client_secret'),
                'scope' => '*',
            ],
        ]);

        $content = $response->getBody()->getContents();
        Log::debug($content);

        $body = json_decode($content, true);

        $this->token = $body['access_token'];

        // $user = new User();
        // $user->id = $identifier;

        $response = $this->httpClient->request('GET', '/api/user/' . $identifier, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $attributes = json_decode($response->getBody()->getContents(), true);

        $user = new User($attributes);
        $user->token = $this->token;
        return $user;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }
}
