<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class Post extends Pivot
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'cover',
        'description',
        'body',
        'user_id',
    ];

    protected function publishedDate(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('m/d/Y'),
        );
    }

    public function scopeIsLikedByUser($query, int $userId): void
    {
        $subQuery = DB::table('likes')
            ->select(
                'likes.post_id as like_post_id',
                'likes.user_id as like_user_id',
                DB::raw('
                    if(likes.user_id IS NOT NULL, true, false) as isLikedByUser
                    ')
            )->where('user_id', $userId);

        $query->leftJoinSub($subQuery, 'likes', function ($join) {
            $join->on('posts.id', '=', 'likes.like_post_id');
        });
    }

    public function scopeIsSavedByUser($query, int $userId): void
    {
        $subQuery = DB::table('saves')
            ->select(
                'saves.post_id as save_post_id',
                'saves.user_id as save_user_id',
                DB::raw('
                    if(saves.user_id IS NOT NULL, true, false) as isSavedByUser
                ')
            )->where('saves.user_id', $userId);

        $query->leftJoinSub($subQuery, 'saves', function ($join) {
            $join->on('save_post_id', '=', 'posts.id');
        });
    }

    public function scopeTimeline(Builder $query)
    {
        $query->whereIn(
            'user_id',
            DB::table('followers')
                ->select(['followed'])
                ->where('follower', auth()->id())
        );
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function saves(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saves', 'post_id', 'user_id');
    }

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'comments', 'post_id', 'user_id')
            ->withPivot('message')
            ->withTimestamps();
    }
}
