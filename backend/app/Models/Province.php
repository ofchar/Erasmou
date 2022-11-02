<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class Province extends Model
{
    use HasFactory, HasUuid;

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


    public function scopeCountryUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'country', $uuid);
    }

    public function scopeSearch(Builder $query, string $search) : Builder
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }
}
