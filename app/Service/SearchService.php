<?php

namespace App\Service;

use App\Dto\SearchDto;

class SearchService
{
    /**
     *
     * @param SearchDto $dto
     * @return bool|string
     */
    public function execute(
        SearchDto $dto
    ): bool|string {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twitter.com/2/tweets/search/recent?query=' . $dto->query_string . '&tweet.fields=text,author_id,lang',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . config('laravel-twitter-streaming-api.bearer_token'),
                'Cookie: guest_id=v1%3A164389434401851648'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
