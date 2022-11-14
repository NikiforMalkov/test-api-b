<?php

namespace App\Category\Services;

use App\Entities\CategoryTreeNode;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface {

    public function all();

    public function buildTree(Collection $categories): CategoryTreeNode;

}
