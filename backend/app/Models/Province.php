<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Province extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_id',
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'country_id',
    ];


    /**
     * Get Country of this Province.
     */
    public function country() : Relation
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get Cities in this Province.
     */
    public function cities() : ?Relation
    {
        return $this->hasMany(City::class);
    }
}
