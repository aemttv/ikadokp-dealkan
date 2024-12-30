<?php

namespace App\Providers;

use App\Repositories\Primary\PrimaryRepository;
use App\Repositories\Primary\PrimaryRepositoryInterface;
use App\Repositories\Primary\PrimaryService;
use App\Repositories\Secondary\SecondaryRepository;
use App\Repositories\Secondary\SecondaryRepositoryInterface;
use App\Repositories\Secondary\SecondaryService;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Primary Repository
        $this->app->bind(PrimaryRepositoryInterface::class, PrimaryRepository::class);
        $this->app->bind(PrimaryService::class, function ($app) {
            return new PrimaryService($app->make(PrimaryRepositoryInterface::class));
        });

        //Secondary Repository
        $this->app->bind(SecondaryRepositoryInterface::class, SecondaryRepository::class);
        $this->app->bind(SecondaryService::class, function ($app) {
            return new SecondaryService($app->make(SecondaryRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config(['app.locale' => 'id']);
	    Carbon::setLocale('id');
    }
}
