<?php

namespace App\Service;

use App\Dto\TweetDto;

class TweetService
{

    /**
     * @throws \JsonException
     */
    public function execute(TweetDto $dto): bool|string
    {
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
                'Authorization: OAuth oauth_consumer_key="' . config('laravel-twitter-streaming-api.api_key') . '",oauth_token="' . config('laravel-twitter-streaming-api.access_token') . '",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1644010646",oauth_nonce="EqTJimz7c4d",oauth_version="1.0",oauth_signature="vAs97jjtzhdf8WACvtpxY7M%2FnUA%3D"',
                'Content-Type: application/json',
                'Cookie: guest_id=v1%3A164400866500435071'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
