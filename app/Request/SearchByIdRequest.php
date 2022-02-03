<?php

namespace App\Request;

use App\Dto\SearchByIdDto;
use Illuminate\Foundation\Http\FormRequest;

class SearchByIdRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'tweet_ID' => 'required|integer|min:0',
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
            'tweet_ID.integer' => 'Il numero deve essere un intero!',
        ];
    }

    /**
     * @return SearchByIdDto
     */
    public function getDto(): SearchByIdDto
    {
        return SearchByIdDto::create(
            (int)$this->get('tweet_ID')
        );
    }
}
