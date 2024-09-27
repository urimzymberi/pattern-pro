<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class AppServiceProviderContent
{
    public static function get($moduleName)
    {
        return <<<EOD
         <?php

        namespace App\Modules\\{$moduleName}\Providers;

        use Illuminate\Support\ServiceProvider;

        class AppServiceProvider extends ServiceProvider
        {
            /**
             * Register any application services.
             */
            public function register(): void
            {
                //Repositories
            }

            /**
             * Bootstrap any application services.
             */
            public function boot(): void
            {
                //
            }
        }
        EOD;
    }
}
