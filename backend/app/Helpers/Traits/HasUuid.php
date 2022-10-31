<?php

namespace App\Helpers\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
