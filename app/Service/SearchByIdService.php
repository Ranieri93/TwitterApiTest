<?php

namespace App\Service;

use App\Dto\SearchByIdDto;
use Illuminate\Support\Facades\Http;

class SearchByIdService
{
    /**
     * Search with curl call to Twitter API
     * @param SearchByIdDto $dto
     * @return array
     */
    public function execute(SearchByIdDto $dto): array
    {
        $response = Http::withToken(config('laravel-twitter-streaming-api.bearer_token'))->get("https://api.twitter.com/2/tweets/" . $dto->tweet_ID . "?tweet.fields=id");
        return $response->json();
    }
}
