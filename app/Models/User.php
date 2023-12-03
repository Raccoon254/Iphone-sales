<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'billing_information',
        'order_history',
        'cart',
        'wishlist',
        'last_login_at',
        'created_at',
        'updated_at',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
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
        'password' => 'hashed',
    ];

    //is admin
    protected $dates = [
        'last_login_at',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function unreadNotificationCount(): int
    {
        $unreadCount = 0;

        // Loop through each notification associated with the user
        $notifications = $this->allNotifications();
        foreach ($notifications as $notification) {
            if (!$notification->isReadByUser($this->id)) {
                $unreadCount++;
            }
        }

        return $unreadCount;
    }

    //user orders

    public function allNotifications(): \Illuminate\Database\Eloquent\Collection
    {
        return Notification::allForUser($this->id)->get();
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function readNotifications(): \Illuminate\Database\Eloquent\Collection
    {
        return Notification::readForUser($this->id)->get();
    }

    //get unread notifications

    public function getUnreadNotificationsAttribute(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->unreadNotifications();
    }

    public function unreadNotifications(): \Illuminate\Database\Eloquent\Collection
    {
        return Notification::unreadForUser($this->id)->get();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
