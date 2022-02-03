<?php

namespace App\Dto;

class SearchDto
{
    public string $query_string;

    /**
     * @param string $query_string
     */
    public function __construct(string $query_string)
    {
        $this->query_string = $query_string;
    }

    /**
     * @param string $query_string
     * @return SearchDto
     */
    public static function create(
        string $query_string
    ): self {
        return new self(
            $query_string
        );
    }


}
