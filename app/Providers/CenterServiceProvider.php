<?php

namespace App\Providers;

use App\Helpers\CenterServiceHelper;
use Illuminate\Support\ServiceProvider;

class CenterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('CenterService', fn() => new CenterServiceHelper);
        $this->app->alias('CenterService', CenterServiceHelper::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
