<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'PUT'],

    'allowed_origins' => ['http://159.203.87.199', '159.203.87.199', 'localhost:8086', 'http://localhost:8086'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['content-type', 'accept', 'x-custom-header', 'authorization', 'user_key'],

    'exposed_headers' => ['x-custom-response-deader', 'user_key'],

    'max_age' => 60,

    'supports_credentials' => false

];
