<?php

namespace App\Dto;

use JetBrains\PhpStorm\Pure;

class SearchByIdDto
{
    public int $tweet_ID;

    /**
     * @param int $tweet_ID
     */
    public function __construct(int $tweet_ID)
    {
        $this->tweet_ID = $tweet_ID;
    }

    /**
     * @param int $tweet_ID
     * @return static
     */
    public static function create(
        int $tweet_ID
    ): self {
        return new self(
            $tweet_ID
        );
    }


}
