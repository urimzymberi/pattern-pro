<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class PolicyContent
{
    public static function get($moduleName, $policyName, $modelName)
    {
        $lcfirstModelName = lcfirst($modelName);

        return <<<EOD
        <?php

        namespace App\Modules\\{$moduleName}\Policies;

        use App\Modules\\{$moduleName}\Models\\{$modelName};
        use App\Modules\Users\Models\User;

        class {$policyName}
        {
            public function viewAny(User \$user): bool
            {
                //
            }

            public function view(User \$user, {$modelName} \${$lcfirstModelName}): bool
            {
                //
            }
            
            public function create(User \$user): bool
            {
                //
            }

            public function update(User \$user, {$modelName} \${$lcfirstModelName}): bool
            {
                //
            }

            public function delete(User \$user, {$modelName} \${$lcfirstModelName}): bool
            {
                //
            }

            public function restore(User \$user, {$modelName} \${$lcfirstModelName}): bool
            {
                //
            }

            public function forceDelete(User \$user, {$modelName} \${$lcfirstModelName}): bool
            {
                //
            }
            public function create(User \$user): bool
            {
                //
            }

            public function update(User \$user, {$modelName} \${$lcfirstModelName}): bool
            {
                //
            }

            public function delete(User \$user, {$modelName} \${$lcfirstModelName}): bool
            {
                //
            }

            public function restore(User \$user, {$modelName} \${$lcfirstModelName}): bool
            {
                //
            }

            public function forceDelete(User \$user, {$modelName} \${$lcfirstModelName}): bool
            {
                //
            }
        }

        EOD;
    }
}
