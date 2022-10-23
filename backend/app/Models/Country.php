<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
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
     * Get Provinces of this Country.
     */
    public function provinces() : ?Relation
    {
        return $this->hasMany(Province::class);
    }

    /**
     * Get Cities of this Country.
     */
    public function cities() : ?Relation
    {
        return $this->hasMany(City::class);
    }
}
