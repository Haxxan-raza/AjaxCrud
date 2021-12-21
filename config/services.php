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
    'google' => [
        'client_id' => '651229674037-d0clfmkv9gub3jbbvocc0v2ugnudmicp.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8002/auth/google/callback',
],
// 'google' => [
//     'client_id'     => env('1014930853435-jkv5aqv53k6nqru44m6bs95htm4kgh9q.apps.googleusercontent.com'),
//     'client_secret' => env('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'),
//     'redirect'      => env('APP_URL') . 'http://localhost:8002/auth/google/callback',
// ],
];
