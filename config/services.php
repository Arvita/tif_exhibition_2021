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

    // 'google' => [
    //     'client_id' => '330357826345-vc6jjccfbuga7fvl049k2bdsdt6k2fe4.apps.googleusercontent.com',
    //     'client_secret' => 'qk42MQqz87XT7jDDXds-wMbb',
    //     'redirect' => 'http://localhost:8000/google/callback',
    // ],

    'google' => [
        'client_id' => '330357826345-4cc4ji5bd84h8ml9foq1ba294c4r2aq3.apps.googleusercontent.com',
        'client_secret' => '9HLbgXYsTd1foZ4vcP79zzoK',
        'redirect' => 'http://tif-exhibition.arvitaagusk.com/google/callback',
    ],

];
