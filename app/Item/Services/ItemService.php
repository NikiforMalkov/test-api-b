<?php

namespace App\Item\Services;

use App\Elastic\Services\ElasticServiceInterface;
use App\Item\Dto\SearchRequestDto;

class ItemService implements ItemServiceInterface
{
    protected ElasticServiceInterface $elasticService;

    public function __construct(ElasticServiceInterface $elasticService)
    {
        $this->elasticService = $elasticService;
    }

    public function search(SearchRequestDto $searchDto) {
        //TODO: возможно стоит возвращать модели, а не в голом виде, но это небольшое тестовое
        return $this->elasticService->search('item_index', [
            'match' => [
                'name' => $searchDto->query,
            ],
            'match' => [
                'description' => $searchDto->query,
            ]

        ], [
            ['name' => ['order' => $searchDto->orderBy]],
        ]);
    }

}
