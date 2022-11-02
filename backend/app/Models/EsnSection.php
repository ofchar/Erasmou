<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class EsnSection extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
        'university_id',
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
        'city_id',
        'city_university',
    ];


    /**
     * Get City in which EsnSection operates.
     */
    public function city() : ?Relation
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get University in which EsnSection operates.
     */
    public function university() : ?Relation
    {
        return $this->belongsTo(University::class);
    }


    public function scopeCityUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'city', $uuid);
    }

    public function scopeUniversityUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'university', $uuid);
    }

    public function scopeCountryUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'city.country', $uuid);
    }

    public function scopeSearch(Builder $query, string $search) : Builder
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhereHas('city', fn ($q) =>
                $q->where('name', 'like', '%' . $search . '%')
            )
            ->orWhereHas('university', fn ($q) =>
                $q->where('name', 'like', '%' . $search . '%')
            );
    }
}
