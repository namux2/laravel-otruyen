<?php

namespace YourVendor\Otruyen;

use GuzzleHttp\Client;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class OtruyenServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/otruyen.php', 'otruyen');

        $this->app->singleton('otruyen', function ($app) {
            return new Client(['base_uri' => $app['config']['otruyen.base_url']]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/otruyen.php' => config_path('otruyen.php'),
            ], 'config');

            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            $this->commands([
                Console\CrawlCommand::class,
            ]);
        }

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('otruyen:crawl --store')->daily();
        });
    }
}
