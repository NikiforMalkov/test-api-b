<?php

namespace App\Item;

use App\Elastic\Services\ElasticServiceInterface;
use App\Item\Services\ItemService;
use App\Item\Services\ItemServiceInterface;
use Illuminate\Support\ServiceProvider;

class ItemServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->scoped(ItemServiceInterface::class, function ($app) {
            return new ItemService($app->make(ElasticServiceInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
