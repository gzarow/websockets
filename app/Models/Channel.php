<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Channel extends Model
{ 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'slug'
    ];

    /**
     * The users that belong to the channel.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public static function getOptions()
    {
        return self::get()->pluck('name', 'id');
    }
}