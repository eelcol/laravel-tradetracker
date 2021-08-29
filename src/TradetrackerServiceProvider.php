<?php

namespace Eelcol\LaravelTradetracker;

use Eelcol\LaravelTradetracker\Support\Connectors\Tradetracker;
use Illuminate\Support\ServiceProvider;

class TradetrackerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tradetracker.php'   => config_path('tradetracker.php'),
        ], 'laravel-tradetracker');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tradetracker.php', 'tradetracker');

        $this->app->bind('tradetracker', function ($app) {
            return new Tradetracker(config('tradetracker'));
        });
    }
}
