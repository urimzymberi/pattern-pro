<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class ControllerContent
{
    public static function get($moduleName, $modelName, $storeRequestName, $updateRequestName, $serviceName)
    {
        $lcfirstModelName = lcfirst($modelName);
        $lcfirstServiceName = lcfirst($serviceName);

        return <<<EOD
        <?php

        namespace App\Modules\\{$moduleName}\Http\Controllers;

        use App\Http\Controllers\Controller;
        use App\Modules\\{$moduleName}\Http\Requests\\{$storeRequestName};
        use App\Modules\\{$moduleName}\Http\Requests\\{$updateRequestName};
        use App\Modules\\{$moduleName}\Models\\{$modelName};
        use App\Modules\\{$moduleName}\Services\\{$serviceName};
        use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
        use Inertia\Inertia;

        class {$modelName}Controller extends Controller
        {
            use AuthorizesRequests;

            public function __construct(
                protected {$serviceName}    \${$lcfirstServiceName},
            ) {}

            public function index()
            {
               //
            }

             public function create()
            {
               //
            }

            public function store({$storeRequestName} \$request)
            {
               //
            }

            public function show({$modelName} \${$lcfirstModelName})
            {
               //
            }

            public function edit({$modelName} \${$lcfirstModelName})
            {
               //
            }

            public function update({$updateRequestName} \$request, {$moduleName} \${$lcfirstModelName})
            {
               //
            }

            public function destroy({$modelName} \${$lcfirstModelName})
            {
               //
            }
        }
        EOD;
    }
}
