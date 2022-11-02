<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class City extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_id',
        'province_id',
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
        'province_id',
    ];


    /**
     * Get the Province of this City.
     */
    public function province() : ?Relation
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get the Country of this City
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get all Apartments that are in this city.
     */
    public function apartments() : ?Relation
    {
        return $this->hasMany(Apartment::class);
    }

    /**
     * Get all Landlords that are in this city.
     */
    public function landlords() : ?Relation
    {
        return $this->hasMany(Landlord::class);
    }

    /**
     * Get all Universities that are in this city.
     */
    public function universities() : ?Relation
    {
        return $this->hasMany(University::class);
    }


    public function scopeCountryUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'country', $uuid);
    }

    public function scopeProvinceUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'province', $uuid);
    }

    public function scopeSearch(Builder $query, string $search) : Builder
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhereHas('country', fn ($q) =>
                $q->where('name', 'like', '%' . $search . '%')
            )
            ->orWhereHas('province', fn ($q) =>
                $q->where('name', 'like', '%' . $search . '%')
            );
    }
}
