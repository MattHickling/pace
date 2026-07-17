<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Strava extends Model
{
    protected $table = 'strava_accounts';

    protected $fillable = [
        'user_id',
        'strava_athlete_id',
        'access_token',
        'refresh_token',
        'expires_at',
        'scope',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
