<?php

declare(strict_types=1);

namespace Codeat3\BladeMicrons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

final class BladeMicronsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-microns', []);

            $factory->add('microns', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-microns.php', 'blade-microns');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-microns'),
            ], 'blade-microns');

            $this->publishes([
                __DIR__.'/../config/blade-microns.php' => $this->app->configPath('blade-microns.php'),
            ], 'blade-microns-config');
        }
    }
}
