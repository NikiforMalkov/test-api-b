<?php

namespace App\Category\Dto;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class UpdateCategoryRequestDto extends DataTransferObject
{

    public int $id;
	public string $name;
	public $parent_id;
    public int $index;

}
