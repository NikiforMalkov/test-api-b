<?php
namespace App\Category\Requests;

use App\Category\Dto\UpdateCategoryRequestDto;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'parent_id' => [
                'nullable',
                'numeric'
            ],
            'index' => [
                'nullable',
                'numeric'
            ],
        ];
    }

    public function data()
    {
        return new UpdateCategoryRequestDto([
            'id' => $this->route('id'),
            'name' => $this->input('name'),
            'parent_id' => $this->input('parent_id', null),
            'index' => $this->input('index', 0),
        ]);
    }
}
