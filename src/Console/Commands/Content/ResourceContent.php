<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class ResourceContent
{
    public static function get($moduleName, $resourceName)
    {
        return <<<EOD
        <?php

        namespace App\Modules\\{$moduleName}\Http\Resources;

        use Illuminate\Http\Request;
        use Illuminate\Http\Resources\Json\JsonResource;

        class {$resourceName} extends JsonResource
        {
            public function toArray(Request \$request): array
            {
                return [
                    // Add resource fields here
                ];
            }
        }

        EOD;
    }
}
