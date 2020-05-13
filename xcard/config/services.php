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
        'client_id' => '450321292530962',
        'client_secret' => 'd19fa68558f066829bc86097c12620d8',
        'redirect' => 'http://localhost:8000/login/facebook',
    ],
    'google' => [
        'client_id'     => '631267522004-eb8iu6baers93p9k520cdbv86qcue0kg.apps.googleusercontent.com',
        'client_secret' => 'xCx4TjgCV40lMHxqLReV4vXX',
        'redirect'      => 'http://localhost:8000/login/google'
    ],

];
