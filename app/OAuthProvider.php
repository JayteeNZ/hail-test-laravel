<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OAuthProvider extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'oauth_providers';

    /**
     * The fields that can be mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
        'provider_user_id',
        'user_id',
        'name'
    ];

    /**
     * The attributes that should be excluded.
     * 
     * @var array
     */
    protected $hidden = [
        'refresh_token',
        'access_token'
    ];

    /**
     * Get the user who owns the social account provider.
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
