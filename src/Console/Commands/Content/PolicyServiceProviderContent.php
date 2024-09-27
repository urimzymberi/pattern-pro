<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class PolicyServiceProviderContent
{
    public static function get($moduleName)
    {
        return <<<EOD
         <?php

        namespace App\Modules\\{$moduleName}\Providers;

        use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

        class PolicyServiceProvider extends ServiceProvider
        {
            protected \$policies = [

            ];
        }
        EOD;
    }
}
