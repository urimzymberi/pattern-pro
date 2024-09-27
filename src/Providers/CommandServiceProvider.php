<?php

namespace Urimz\PatternPro\Providers;

use Illuminate\Support\ServiceProvider;
use Urimz\PatternPro\Console\Commands\MakeModuleModelAll;

class CommandServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            MakeModuleModelAll::class,
        ]);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/pattern-pro.php' => config_path('pattern-pro.php'),
        ], 'config');
    }
}
