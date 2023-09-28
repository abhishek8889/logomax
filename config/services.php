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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
<<<<<<< HEAD
        'redirect' => 'http://127.0.0.1:8000/authorized/google/callback',
=======
        'redirect' => 'https://sagmetic.site/2023/laravel/logomax/authorized/google/callback',
>>>>>>> 9633f5cdb49efd52e0c76149c8d743915daf3204
    ],
    'facebook' => [
        'client_id' => env('META_CLIENT_ID'),
        'client_secret' => env('META_CLIENT_SECRET'),
<<<<<<< HEAD
        'redirect' => 'http://127.0.0.1:8000/authorized/facebook/callback',
=======
        'redirect' => 'https://sagmetic.site/2023/laravel/logomax/authorized/facebook/callback',
>>>>>>> 9633f5cdb49efd52e0c76149c8d743915daf3204
    ],
    
];
