<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

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
}
