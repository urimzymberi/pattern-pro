<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class BaseRepositoryContent
{
    public static function get(): string
    {
        return <<<EOD
        <?php

        namespace App\Modules\Shared\Repositories;
        
        use Illuminate\Support\Str;
        
        class BaseRepository
        {
            protected \$model;
        
            public function all(): object
            {
                return \$this->model->orderBy('id', 'desc')->paginate(15);
            }
        
            public function find(int \$id): object
            {
                return \$this->model->findOrFail(\$id);
            }
        
            public function create(array \$data): object
            {
                return \$this->model->create(\$data);
            }
        
            public function update(array \$data, int \$id): object
            {
                \$record = \$this->model->findOrFail(\$id);
                \$record->update(\$data);
                return \$record;
            }
        
            public function delete(int \$id): void
            {
                \$this->model->findOrFail(\$id)->delete();
            }
        
            public function allSimple(): object
            {
                return \$this->model->orderBy('name')->select(['id', 'name'])->get();
            }
        }

        EOD;
    }
}
