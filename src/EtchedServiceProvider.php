<?php

namespace OllieCodes\Etched;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class EtchedServiceProvider extends ServiceProvider
{
    private static $etchedTheme = null;

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishAssets();
        }

        $this->registerViews();
        $this->registerBladeDirectives();
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
        $this->registerEtchedViewEngine();
    }

    private function registerBladeDirectives(): void
    {
        $compiler = $this->app->make(BladeCompiler::class);

        // Register the core etched directive
        $compiler->directive('etched', function ($expression) {
            self::$etchedTheme = $expression;

            return '<?php \OllieCodes\Etched\Facades\Etched::render(\'';
        });


        $compiler->directive('endetched', function () {
            $theme             = self::$etchedTheme;
            self::$etchedTheme = null;

            return '\'' . ($theme ? ', ' . $theme : '') . '); ?>';
        });
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

    private function registerEtchedViewEngine(): void
    {
        $this->app->get('view.engine.resolver')->register('etched', function () {
            return new EtchedEngine($this->app->make(Etched::class), $this->app['files']);
        });

        $this->app->get('view')->addExtension('md', 'etched');
    }

    private function registerViews(): void
    {
        // Register the views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'etched');
    }
}