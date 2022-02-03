<?php

namespace App\Request;

use App\Dto\TweetDto;
use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'tweet_text' => 'required|string',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'tweet_text.string' => 'The input must be a string!',
        ];
    }

    /**
     * @return TweetDto
     */
    public function getDto(): TweetDto
    {
        return TweetDto::create(
            (string)$this->get('tweet_text')
        );
    }
}
