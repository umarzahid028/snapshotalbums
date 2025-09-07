<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
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
        'name', 'email', 'password', 'company_name', 'role_id', 'google_id','access_token','refresh_token','stripe_customer_id','renew_status','status','plan','subscription_active','trial_ends_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
    ];

    public function role()
    {
       return $this->belongsTo('App\Models\User\Role');
    }

    public function createFolders()
    {
        return $this->hasMany(CreateFolder::class);
    }

    public function userPayments()
    {
        return $this->hasMany(UserPayment::class);
    }
    
    /**
     * Check if user has active subscription or trial
     */
    public function hasActiveSubscription()
    {
        // Premium users with active subscription
        if ($this->plan === 'premium' && $this->subscription_active) {
            return true;
        }
        
        // Basic users with active subscription
        if ($this->plan === 'basic' && $this->subscription_active) {
            return true;
        }
        
        // Trial users within trial period
        if ($this->plan === 'trial' && $this->trial_ends_at && now()->isBefore($this->trial_ends_at)) {
            return true;
        }
        
        // Users with renew_status = 1 (legacy payment system)
        if ($this->renew_status == '1') {
            return true;
        }
        
        return false;
    }
    
    /**
     * Check if user can create unlimited albums
     */
    public function canCreateUnlimitedAlbums()
    {
        return $this->plan === 'premium' && $this->hasActiveSubscription();
    }
    
    /**
     * Check if user can create albums (limited by plan)
     */
    public function canCreateAlbum()
    {
        if (!$this->hasActiveSubscription()) {
            return false;
        }
        
        // Premium users can create unlimited albums
        if ($this->plan === 'premium') {
            return true;
        }
        
        // Basic users can create only 1 album
        if ($this->plan === 'basic') {
            $albumCount = $this->createFolders()->count();
            return $albumCount < 1;
        }
        
        // Trial users can create unlimited albums during trial
        if ($this->plan === 'trial') {
            return true;
        }
        
        return false;
    }
    
    /**
     * Get user's album limit
     */
    public function getAlbumLimit()
    {
        if (!$this->hasActiveSubscription()) {
            return 0;
        }
        
        switch ($this->plan) {
            case 'premium':
                return -1; // Unlimited
            case 'basic':
                return 1;
            case 'trial':
                return -1; // Unlimited during trial
            default:
                return 0;
        }
    }
    
    /**
     * Get user's current album count
     */
    public function getAlbumCount()
    {
        return $this->createFolders()->count();
    }
}
