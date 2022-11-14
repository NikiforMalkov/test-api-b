<?php

namespace App\Item\Dto;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class SearchRequestDto extends DataTransferObject
{
	public string $query;
	public string $orderBy;

}
