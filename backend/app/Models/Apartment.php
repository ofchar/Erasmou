<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class Apartment extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'landlord_id',
        'user_id',
        'name',
        'description',
        'foreign_url',
        'city_id',
        'road',
        'building_number',
        'apartment_number',
        'longitude',
        'latitude',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'landlord_id',
        'user_id',
        'city_id',
    ];


    /**
     * Get the Landlord that owns this apartment.
     */
    public function landlord() : Relation
    {
        return $this->belongsTo(Landlord::class);
    }

    /**
     * Get the User that added this apartment.
     */
    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the City of this apartment.
     */
    public function city() : Relation
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the Rates of this apartment.
     */
    public function rates() : Relation
    {
        return $this->morphMany(Rate::class, 'targetable');
    }


    public function scopeLandlordUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'landlord', $uuid);
    }

    public function scopeUserUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'user', $uuid);
    }

    public function scopeCityUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'city', $uuid);
    }

    public function scopeSearch(Builder $query, string $search) : Builder
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('road', 'like', '%' . $search . '%')
            ->orWhereHas('landlord', fn ($q) =>
                $q->where('name', 'like', '%' . $search . '%')
            )
            ->orWhereHas('city', fn ($q) =>
                $q->where('name', 'like', '%' . $search . '%')
            );
    }
}
