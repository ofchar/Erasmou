<?php

namespace App\Models;

use App\Helpers\Traits\HasUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid;

    const TYPE_USER = 10;
    const TYPE_FUTURE_ERASMUS = 20;
    const TYPE_ERASMUS = 30;
    const TYPE_ESN = 40;
    const TYPE_ADMIN = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'phone',
        'bio',
        'type',
        'country_id',
        'city_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get Apartments added by this User.
     */
    public function apartments() : ?Relation
    {
        return $this->hasMany(Apartment::class);
    }

    /**
     * Get Landlords added by this User.
     */
    public function landlords() : ?Relation
    {
        return $this->hasMany(Landlord::class);
    }

    /**
     * Get Posts added by this User.
     */
    public function posts() : ?Relation
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get Rates added by this User.
     */
    public function rates() : ?Relation
    {
        return $this->hasMany(Rate::class);
    }
}
