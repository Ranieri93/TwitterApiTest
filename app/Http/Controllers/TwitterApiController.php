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
     * Return view to search
     * @return Application|Factory|View
     */
    public function indexTweet(): View|Factory|Application
    {
        return view('Core.tweet');
    }

    /**
     * @param TweetRequest $request
     * @param TweetService $tweetService
     * @return bool|string
     * @throws \JsonException
     */
    public function tweetHandler(
        TweetRequest $request,
        TweetService $tweetService
    ): bool|string {
        return $tweetService->execute($request->getDto());
    }

    public function indexSearch(): View|Factory|Application
    {
        return view('Core.search');
    }

    public function searchHandler(
        SearchRequest $request,
        SearchService $searchService
    ) {
        return $searchService->execute($request->getDto());
    }
}
