<?php

namespace Urimz\PatternPro\Console\Commands\Content;

class UpdateRequestContent
{
    public static function get($moduleName, $updateRequestName)
    {
        return <<<EOD
        <?php

        namespace App\Modules\\{$moduleName}\Http\Requests;

        use Illuminate\Foundation\Http\FormRequest;

        class {$updateRequestName} extends FormRequest
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
