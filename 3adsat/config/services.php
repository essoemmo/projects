<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],


    'facebook' => [
        'client_id' => '524275381496282',
        'client_secret' => '77ceb9ee711158e42dd9c5eb32cc2a9d',
        'redirect' => 'https://www.qeyeq.com/callback/facebook',
    ],

    'google' => [
        'client_id' => '631267522004-qqdn76ceou25fsiq00hunmugpkbedm62.apps.googleusercontent.com',
        'client_secret' => 'xK1USzBv0KiZvOIly8RJUkkP',
        'redirect' => 'https://www.qeyeq.com/callback/google',
    ],

];
