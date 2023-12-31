<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    /*'facebook' => [
        'client_id' => '967186797063633',
        'client_secret' => 'cf8809fcc502890072d63572b4d1f335',
        'redirect' => 'https://clients.howkar.com/callback/facebook',
    ],*/

    'facebook' => [
        'client_id' => '1092841357718647',
        'client_secret' => '13115cf1e8ea8b246b3eb74f05cd177a',
        'redirect' => 'https://8b7d36949bd5.ngrok.io/callback/facebook',
    ],

];
