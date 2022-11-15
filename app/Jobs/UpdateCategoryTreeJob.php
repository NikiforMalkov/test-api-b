<?php

namespace App\Jobs;

use App\Category\Services\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class UpdateCategoryTreeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Category $category;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CategoryServiceInterface $categoryService)
    {
        $categories = Category::query()->get();
        $tree = $categoryService->buildTree($categories);
        $result = $tree->toArray();
        Cache::put('categories', $result);
    }
}
