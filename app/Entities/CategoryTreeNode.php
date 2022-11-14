<?php

namespace App\Entities;

use Illuminate\Support\Collection;

class CategoryTreeNode
{
    protected int $categoryId;
    protected string $name;
    protected int $index;

    protected Collection $childNodes;

    /**
     * CategoryTreeNode constructor.
     */
    public function __construct()
    {
        $this->childNodes = collect();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CategoryTreeNode
     */
    public function setName(string $name): CategoryTreeNode
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     * @return CategoryTreeNode
     */
    public function setCategoryId(?int $categoryId): CategoryTreeNode
    {
        $this->categoryId = $categoryId ?? 0;
        return $this;
    }

    /**
     * @param int $categoryId
     * @return CategoryTreeNode
     */
    public function setIndex(int $index): CategoryTreeNode
    {
        $this->index = $index;
        return $this;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @return Collection
     */
    public function getChildNodes(): Collection
    {
        return $this->childNodes;
    }

    /**
     * @param Collection $childNodes
     * @return CategoryTreeNode
     */
    public function setChildNodes(Collection $childNodes): CategoryTreeNode
    {
        $this->childNodes = $childNodes;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->categoryId,
            'name' => $this->name,
            'index' => $this->index,
            'childNodes' => $this->childNodes->sortBy(function ($node) {
                return $node->getIndex();
            }, SORT_REGULAR, false)->map(fn(CategoryTreeNode $node) => $node->toArray())->toArray(),
        ];
    }
}
