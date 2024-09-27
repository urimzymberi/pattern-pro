<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class RepositoryInterfaceContent
{
    public static function get($moduleName, $repositoryInterfaceName)
    {
        return <<<EOD
        <?php

        namespace App\Modules\\{$moduleName}\Repositories\Contracts;

        interface {$repositoryInterfaceName}
        {
            public function all(): object;

            public function find(int \$id): object;

            public function create(array \$data): object;

            public function update(array \$data, int \$id): object;

            public function delete(int \$id): void;
        }

        EOD;
    }
}
