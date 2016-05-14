<?php

return [

    /*
     * Redirect url after login
     */
    'redirect_url' => '/social-auth/steam',
    /*
     *  Api Key (http://steamcommunity.com/dev/apikey)
     */
    'api_key' => env('STEAM_CLIENT_ID'),

    /**
     * Is using https?
     */
    'https' => false
];
