<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class StoreRequestContent
{
    public static function get($moduleName, $storeRequestName)
    {
        return <<<EOD
        <?php

        namespace App\Modules\\{$moduleName}\Http\Requests;

        use Illuminate\Foundation\Http\FormRequest;

        class {$storeRequestName} extends FormRequest
        {
            public function authorize(): bool
            {
                return false;
            }

            public function rules(): array
            {
                return [
                    // Define rules here
                ];
            }
        }

        EOD;
    }
}
