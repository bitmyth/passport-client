<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Oauth Client Credential
    |--------------------------------------------------------------------------
    |
    | https://laravel.com/docs/master/passport#client-credentials-grant-tokens
    | The client credentials grant is suitable for machine-to-machine authentication.
    | For example, you might use this grant in a scheduled job which is performing maintenance tasks over an API.
    |
    */

    'client_credentials' => [
        'client_id' => env('OAUTH_CLIENT_ID'),
        'client_secret' => env('OAUTH_CLIENT_SECRET')
    ]

];
