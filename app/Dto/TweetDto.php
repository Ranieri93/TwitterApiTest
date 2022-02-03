<?php

namespace App\Dto;

class TweetDto
{
    public string $tweet_text;

    /**
     * @param string $tweet_text
     */
    public function __construct(string $tweet_text)
    {
        $this->tweet_text = $tweet_text;
    }

    public static function create(
        string $tweet_text
    ): self {
        return new self(
            $tweet_text
        );
    }


}
