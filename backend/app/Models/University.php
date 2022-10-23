<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class University extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_id',
        'city_id',
        'name',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'country_id',
        'city_id',
    ];


    /**
     * Get Country of this University.
     */
    public function country() : Relation
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get City of this University.
     */
    public function city() : Relation
    {
        return $this->belongsTo(City::class);
    }
}
