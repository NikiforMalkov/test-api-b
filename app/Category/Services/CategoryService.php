<?php

namespace App\Category\Services;

use App\Category\Dto\UpdateCategoryRequestDto;
use App\Category\Entities\CategoryTreeNode;
use App\Jobs\UpdateCategoryTreeJob;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryService implements CategoryServiceInterface
{

    public function all() {
        //TODO: собираем категории только через очередь
        //TODO: перключаемся на redis или что-то такое
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

    public function update(UpdateCategoryRequestDto $categoryDto): Category
    {
        //TODO: можно разбить на отдельный слой работы с бд - репозиторий
        $category = Category::where(['id' => $categoryDto->id])->firstOrFail();
        $category->fill([
            'name' => $categoryDto->name,
            'parent_id' => $categoryDto->parent_id,
            'index' => $categoryDto->index,
        ]);
        $category->save();
        //TODO: переместить в конфиги время
        UpdateCategoryTreeJob::dispatch($category)->delay(now()->addSeconds(30));
        return $category;
    }

}
