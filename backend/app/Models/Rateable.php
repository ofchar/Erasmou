<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class Rateable extends Model
{
    use HasFactory;

    const TYPE_INT = 1;
    const TYPE_FLOAT = 2;
    const TYPE_STRING = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'targetable_type',
        'data_type',
        'description',
        'min_value',
        'max_value',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
    ];


    /**
     * Get all Rates of this Rateable type.
     */
    public function rates() : ?Relation
    {
        return $this->hasMany(Rate::class);
    }
}
