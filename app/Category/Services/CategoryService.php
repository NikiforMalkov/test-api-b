<?php

namespace App\Category\Services;

use App\Entities\CategoryTreeNode;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryService implements CategoryServiceInterface
{

    public function all() {
        //TODO: собираем категории только через очередь
        if (!Cache::has('categories')) {
            $categories = Category::query()->get();
            $tree = $this->buildTree($categories);
            $result = $tree->toArray();
            Cache::put('categories', $result);
            return $result;
        } else {
            return Cache::get('categories');
        }
    }

    public function buildTree(Collection $categories): CategoryTreeNode
    {
        $childNodes = [];

        foreach ($categories as $category) {
            $parentId = $category->parent_id ?? 0;
            $childNodes[$parentId] = collect([...($childNodes[$parentId] ?? []), $category]);
        }

        $root = (new CategoryTreeNode())
            ->setName('')
            ->setIndex(0)
            ->setCategoryId(null);

        return $this->buildTreeRecursive($root, $childNodes);
    }

    protected function buildTreeRecursive(CategoryTreeNode $parent, array $childNodes): CategoryTreeNode
    {
        $branches = collect();

        $childCategories = $childNodes[$parent->getCategoryId()] ?? [];

        foreach ($childCategories as $childCategory) {
            $branch = (new CategoryTreeNode())
                ->setName($childCategory->name)
                ->setIndex($childCategory->index)
                ->setCategoryId($childCategory->id);

            $branch = $this->buildTreeRecursive($branch, $childNodes);

            $branches->add($branch);
        }

        $parent->setChildNodes($branches);

        return $parent;
    }

}
