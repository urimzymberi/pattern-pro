<?php

namespace Urimz\PatternPro\Console\Commands\Content;

use Illuminate\Support\Str;

class ServiceContent
{
    public static function get($moduleName, $serviceName, $repositoryInterfaceName)
    {
        $lcfirstRepositoryName = lcfirst(Str::studly($repositoryInterfaceName));

        return <<<EOD
        <?php

        namespace App\Modules\\{$moduleName}\Services;

        use App\Modules\\{$moduleName}\Repositories\Contracts\\{$repositoryInterfaceName};

        class {$serviceName}
        {
            public function __construct(protected {$repositoryInterfaceName} \${$lcfirstRepositoryName})
            {
            }

            public function all(): object
            {
                return \$this->{$lcfirstRepositoryName}->all();
            }

             public function find(int \$id): object
            {
                return \$this->{$lcfirstRepositoryName}->find(\$id);
            }

            public function create(array \$data): object
            {
                return \$this->{$lcfirstRepositoryName}->create(\$data);
            }

            public function update(array \$data, int \$id): object
            {
                return \$this->{$lcfirstRepositoryName}->update(\$data, \$id);
            }

            public function delete(int \$id): void
            {
                \$this->{$lcfirstRepositoryName}->delete(\$id);
            }
        }

        EOD;
    }
}
