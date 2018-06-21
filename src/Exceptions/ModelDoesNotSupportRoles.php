<?php

namespace Spatie\Permission\Exceptions;

use Illuminate\Support\Collection;

class ModelDoesNotSupportRoles extends \Exception
{
    public static function create(string $modelClass)
    {
        return new static("The model: `{$modelClass}` is not using the trait `Spatie\Permission\Traits\HasRoles` so no role can be assigned");
    }
}
