<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'forum_id',
        'user_id',
        'title',
        'body',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'forum_id',
        'user_id',
    ];


    /**
     * Get Forum to which this Post belongs.
     */
    public function forum() : Relation
    {
        return $this->belongsTo(Forum::class);
    }

    /**
     * Get User which sent this Post.
     */
    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }
}
