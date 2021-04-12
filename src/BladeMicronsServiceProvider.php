<?php

declare(strict_types=1);

namespace Codeat3\BladeMicrons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladeMicronsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('microns', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'microns',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-microns'),
            ], 'blade-microns');
        }
    }
}
