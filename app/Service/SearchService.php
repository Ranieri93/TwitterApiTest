<?php

namespace App\Service;

use App\Dto\SearchDto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SearchService
{
    /**
     * Uses vanilla php curl handler to perform a post request and search for daily posts with a keyword
     * @param SearchDto $dto
     * @return bool|string
     */
    public function execute(
        SearchDto $dto
    ): bool|string {
        $today = Carbon::today()->toImmutable()->format('Y-m-d');
        $now = Carbon::now()->toImmutable()->subMinute()->format('H:i:s');

        return Http::withToken(config('laravel-twitter-streaming-api.bearer_token'))
                   ->get('https://api.twitter.com/2/tweets/search/recent?query=' . $dto->query_string . '&tweet.fields=created_at,text,author_id,lang&end_time=' . $today . 'T' . $now . '.000Z&start_time=' . $today . 'T00:00:10.000Z')
        ;

        /**
         * Here you can find vanilla php curl version
         */
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://api.twitter.com/2/tweets/search/recent?query=' . $dto->query_string . '&tweet.fields=created_at,text,author_id,lang&end_time=' . $today . 'T' . $now . '.000Z&start_time=' . $today . 'T00:00:10.000Z',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'GET',
//            CURLOPT_HTTPHEADER => array(
//                'Authorization: Bearer ' . config('laravel-twitter-streaming-api.bearer_token'),
//                'Cookie: guest_id=v1%3A164389434401851648'
//            ),
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//        return $response;
    }
}

