<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class Landlord extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
        'user_id',
        'name',
        'phone',
        'email',
        'website',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'city_id',
        'user_id',
    ];


    /**
     * Get main City in which this Landlord operates.
     */
    public function city() : Relation
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get User which added this Landlord
     */
    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all Apartments this Landlord has.
     */
    public function apartments() : ?Relation
    {
        return $this->hasMany(Apartment::class);
    }


    public function scopeCityUuid(Builder $query, string $uuid) : Builder
    {
        return $this->baseUuidScope($query, 'city', $uuid);
    }

    public function scopeSearch(Builder $query, string $search) : Builder
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('website', 'like', '%' . $search . '%')
            ->orWhereHas('city', fn ($q) =>
                $q->where('name', 'like', '%' . $search . '%')
            );
    }
}
