<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class RepositoryContent
{
    public static function get($moduleName, $repositoryName, $repositoryInterfaceName, $modelName)
    {
        return <<<EOD
        <?php

        namespace App\Modules\\{$moduleName}\Repositories;

        use App\Modules\\{$moduleName}\Repositories\Contracts\\{$repositoryInterfaceName};
        use App\Modules\\{$moduleName}\Models\\{$modelName};
        use App\Modules\Shared\Repositories\BaseRepository;

        class {$repositoryName} extends BaseRepository implements {$repositoryInterfaceName}
        {
            public function __construct({$modelName} \$model)
            {
                \$this->model = \$model;
            }
        }

        EOD;
    }
}
