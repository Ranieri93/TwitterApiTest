<?php

namespace App\Http\Controllers;

use App\Request\SearchByIdRequest;
use App\Request\SearchRequest;
use App\Request\TweetRequest;
use App\Service\SearchByIdService;
use App\Service\SearchService;
use App\Service\TweetService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller as BaseController;

class TwitterApiController extends BaseController
{
    /**
     * Return view to search
     * @return Application|Factory|View
     */
    public function indexSearchByIds(): View|Factory|Application
    {
        return view('Core.searchById');
    }

    /**
     * Calling search service
     * @param SearchByIdRequest $request
     * @param SearchByIdService $searchByIdService
     * @return array
     */
    public function searchByIdsHandler(
        SearchByIdRequest $request,
        SearchByIdService $searchByIdService
    ): array {
        return $searchByIdService->execute($request->getDto());
    }


    /**
     * Return view to post a tweet
     * @return Application|Factory|View
     */
    public function indexTweet(): View|Factory|Application
    {
        return view('Core.tweet');
    }

    /**
     * Call service that posts a tweet
     * @param TweetRequest $request
     * @param TweetService $tweetService
     * @throws \JsonException
     */
    public function tweetHandler(
        TweetRequest $request,
        TweetService $tweetService
    ): object {
        return $tweetService->execute($request->getDto());
    }

    /**
     * Returning view for recent search
     * @return View|Factory|Application
     */
    public function indexSearch(): View|Factory|Application
    {
        return view('Core.search');
    }

    /**
     * Calling service for daily tweets
     * @param SearchRequest $request
     * @param SearchService $searchService
     * @return bool|string
     */
    public function searchHandler(
        SearchRequest $request,
        SearchService $searchService
    ): bool|string {
        return $searchService->execute($request->getDto());
    }
}
