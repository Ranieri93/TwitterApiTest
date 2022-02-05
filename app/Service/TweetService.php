<?php

namespace App\Service;

use App\Dto\TweetDto;
use Coderjerk\BirdElephant\BirdElephant;
use Coderjerk\BirdElephant\Compose\Tweet;


class TweetService
{

    /**
     * @throws \JsonException
     */
    public function execute(TweetDto $dto)
    {
        $credentials = array(
            'bearer_token' => config('laravel-twitter-streaming-api.bearer_token'), // OAuth 2.0 Bearer Token requests
            'consumer_key' => config('laravel-twitter-streaming-api.api_key'), // identifies your app, always needed
            'consumer_secret' => config('laravel-twitter-streaming-api.api_secret_key'), // app secret, always needed
            'token_identifier' => config('laravel-twitter-streaming-api.access_token'), // OAuth 1.0a User Context requests
            'token_secret' => config('laravel-twitter-streaming-api.access_secret_token'), // OAuth 1.0a User Context requests
        );


        $twitter = new BirdElephant($credentials);
        $tweet = (new Tweet)->text($dto->tweet_text);
        return $twitter->tweets()->tweet($tweet);
    }
}
