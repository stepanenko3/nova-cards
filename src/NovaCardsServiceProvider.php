<?php

namespace Stepanenko3\NovaCards;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class NovaCardsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->config();

        $this->app->booted(function (): void {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event): void {
            Nova::script('nova-cards', __DIR__ . '/../dist/js/entry.js');
            Nova::style('nova-cards', __DIR__ . '/../dist/css/card.css');
        });
    }

    public function register(): void
    {
        $this->app->singleton(MarkdownConverter::class, LaravelMarkdownConverter::class);
    }

    protected function routes(): void
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->prefix('nova-vendor/stepanenko3/nova-cards')
            ->group(__DIR__ . '/../routes/api.php');
    }

    private function config(): void
    {
        if ($this->app->runningInConsole()) {
            // Publish config
            $this->publishes([
                __DIR__ . '/../config/' => config_path(),
            ], 'config');
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../config/nova-cards.php',
            'nova-cards'
        );
    }
}
