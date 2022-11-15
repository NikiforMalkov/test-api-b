<?php

namespace App\Category\Services;

use App\Category\Dto\UpdateCategoryRequestDto;
use App\Category\Entities\CategoryTreeNode;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface {

    public function all();

    public function update(UpdateCategoryRequestDto $category): Category;

    public function buildTree(Collection $categories): CategoryTreeNode;

}
