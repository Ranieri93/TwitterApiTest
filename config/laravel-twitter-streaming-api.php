<?php

return [

    /*
     * To work with Twitter's Streaming API you'll need some credentials.
     *
     * If you don't have credentials yet, head over to https://developers.twitter.com/
     */

    'handle' => env('TWITTER_HANDLE'),

    'api_key' => env('TWITTER_CONSUMER_KEY'),

    'api_secret_key' => env('TWITTER_CONSUMER_SECRET'),

    'bearer_token' => env('TWITTER_BEARER_TOKEN'),

    'access_token' => env('TWITTER_ACCESS_TOKEN'),

    'access_secret_token' => env('TWITTER_ACCESS_TOKEN_SECRET'),
];
