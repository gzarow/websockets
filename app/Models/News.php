<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'channel_id'
    ];
    /**
     * Get the channle that owns the news.
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }
    
    public static function getSubscribed($ids)
    {
        return self::query()->whereIn('channel_id', $ids)
            ->orderBy('id', 'desc')
            ->get();
    }
}