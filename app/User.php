<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'avatar_url'
    ];

    /**
     * Append to the user JSON response.
     * 
     * @var array
     */
    protected $appends = [
        'full_name'
    ];

    /**
     * Get the user's oauth providers.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany(OAuthProvider::class);
    }

    /**
     * Get the full name of the user.
     * 
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Retrieve the hail provider for the user.
     * 
     * @return App\OAuthProvider
     */
    public function getHailProvider()
    {
        return $this->providers()->where('name', 'hail')->first();
    }
}
