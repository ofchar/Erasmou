<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public function baseUuidScope(Builder $query, string $relationName, string $uuid) : Builder
    {
        return $query->whereHas($relationName, fn ($q) =>
            $q->whereUuid($uuid)
        );
    }

    public function baseMorphUuidScope(Builder $query, string $relationName, string $uuid) : Builder
    {
        return $query->whereHasMorph($relationName, '*', fn ($q) =>
            $q->whereUuid($uuid)
        );
    }
}
