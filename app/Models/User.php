<?php

namespace App\Models;



use App\Enums\FriendRequestStatus;
use App\Traits\CustomizeDate;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CustomizeDate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
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
    ];



    public function media():MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    public function sentFriendRequests():HasMany
    {
        return $this->hasMany(FriendRequest::class, 'sender_id')->where('status', FriendRequestStatus::PENDING);
    }
    public function receivedFriendRequests():HasMany
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id')->where('status', FriendRequestStatus::PENDING);
    }
    public function friends():BelongsToMany
    {
        return $this->belongsToMany(User::class, Friend::class,'user_id','friend_id')->withTimestamps();
    }

    public function getFriends()
    {
        return DB::table('friends')->where('user_id',auth()->id())->orWhere('friend_id',auth()->id())->get()
            ->map(function ($friend){
                // Return the ID of the friend, whichever is not the current user
                return $friend->user_id === auth()->id() ? $friend->friend_id : $friend->user_id;
            })
            ->toArray();
    }
}
