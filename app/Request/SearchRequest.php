<?php

namespace App\Request;

use App\Dto\SearchDto;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'query_string' => 'required|string',
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
            'query_string.string' => 'The input must be a string!',
        ];
    }

    /**
     * @return SearchDto
     */
    public function getDto(): SearchDto
    {
        return SearchDto::create(
            (string)$this->get('query_string')
        );
    }
}
