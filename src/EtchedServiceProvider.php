<?php

namespace OllieCodes\Etched;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;

class EtchedServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishAssets();
        }

        $this->registerViews();
    }

    private function publishAssets(): void
    {
        // Publish the config
        $this->publishes([
            __DIR__ . '/../config/etched.php' => config_path('etched.php'),
        ], 'config');
    }

    public function register()
    {
        $this->registerEtchedService();
    }

    private function registerEtchedService(): void
    {
        // Register the etched service as shared
        $this->app->bind(Etched::class, function () {
            return new Etched(
                config('etched'),
                $this->app->make(Factory::class)
            );
        }, true);
    }

    private function registerViews(): void
    {
        // Register the views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'etched');
    }
}