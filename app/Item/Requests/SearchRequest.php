<?php
namespace App\Item\Requests;

use App\Item\Dto\SearchRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class SearchRequest extends FormRequest
{
    public function rules()
    {
        return [
            'query' => [
                'required',
            ],
            'orderBy' => [
                'nullable',
                'in:desc,asc'
            ],
        ];
    }

    public function data()
    {
        return new SearchRequestDto([
            'query' => $this->input('query'),
            'orderBy' => $this->input('orderBy', 'desc'),
        ]);
    }
}
