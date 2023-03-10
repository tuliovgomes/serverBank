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

    'yampi-api' => [
        'url' => env('YAMPI_API_URL', 'http://api.test'),
        'token' => env('YAMPI_API_TOKEN'),
    ],

    'client-bank' => [
        'public_key' => env('CLIENTBANK_PUBLIC_KEY'),
        'organization_id' => env('CLIENTBANK_ORGANIZATION_ID'),
        'project_id' => env('CLIENTBANK_PROJECT_ID'),
    ],

];
