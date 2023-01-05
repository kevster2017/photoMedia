<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;

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
        'username',
        'email',
        'password',
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


    /* Event fired when user creates an account
    User profile also created wuth default title as the username


    */
    protected static function boot()
    {

        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username,
            ]);
            Mail::to($user->email)->send(new NewUserWelcomeMail());
        });
    }

    public function profile()
    {

        return $this->hasOne(Profile::class);
    }

    public function posts()
    {

        return $this->hasMany(Post::class)->orderBy('id', 'DESC');
    }


    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }


    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

    public function followedBy()
    {
        return $this->hasManyThrough(Follow::class, Profile::class);
    }
}
