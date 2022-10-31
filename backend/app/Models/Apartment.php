<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
