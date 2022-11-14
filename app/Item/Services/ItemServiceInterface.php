<?php

namespace App\Item\Services;

use App\Item\Dto\SearchRequestDto;

interface ItemServiceInterface {

    public function search(SearchRequestDto $searchDto);

}
