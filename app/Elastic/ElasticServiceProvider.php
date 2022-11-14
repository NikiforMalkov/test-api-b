<?php

namespace App\Elastic;

use App\Elastic\Services\ElasticService;
use App\Elastic\Services\ElasticServiceInterface;
use Illuminate\Support\ServiceProvider;

class ElasticServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->scoped(ElasticServiceInterface::class, function ($app) {
            return new ElasticService();
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
