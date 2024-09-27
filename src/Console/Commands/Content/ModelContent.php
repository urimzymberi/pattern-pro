<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class ModelContent
{
    public static function get($moduleName, $modelName)
    {
        return <<<EOD
        <?php

        namespace App\Modules\\{$moduleName}\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

        class {$modelName} extends Model
        {
            use HasFactory;
        }

        EOD;
    }
}
