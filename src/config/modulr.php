<?php

return [
    /*
     | App Name
     */
    'app_name' => env('MODULR_API_NAME'),

    /*
     | API Key
     */
    'api_key' => env('MODULR_API_KEY'),

    /*
     | HMAC secret
     */
    'hmac_secret' => env('MODULR_HMAC_SECRET'),

    'environment' => env('MODULR_ENVIRONMENT', 'sandbox'),

    'debug' => env('MODULR_DEBUG', false),
];
