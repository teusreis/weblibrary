<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Profile extends Pivot
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = [
        'username',
        'photo',
        'description',
        'instagram',
        'facebook',
        'twitter',
        'youtube',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
