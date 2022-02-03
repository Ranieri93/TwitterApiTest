<?php

namespace App\Service;

use App\Dto\TweetDto;

class TweetService
{

    public function execute(TweetDto $dto)
    {
//        $response = Http::withToken(config('laravel-twitter-streaming-api.access_token'))->post('https://api.twitter.com/2/tweets', [
//            'text' => $dto->tweet_text,
//        ]);
//
//        dd($response->json());

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twitter.com/2/tweets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "text": "' . $dto->tweet_text . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: OAuth oauth_consumer_key="' . config('laravel-twitter-streaming-api.api_key') . '",oauth_token="' . config('laravel-twitter-streaming-api.access_token') . '",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1643897048",oauth_nonce="TPHGncfQCd8",oauth_version="1.0",oauth_signature="qV%2Fge%2ByJn8fWCYiGWZhiGRawL78%3D"',
                'Content-Type: application/json',
                'Cookie: guest_id=v1%3A164389434401851648'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);
    }
}
