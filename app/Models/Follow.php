<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',

    ];

    public function followedBy(User $user)
    {
        return $this->follows->contains('user_id', $user->id); // Collection method
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function follows()
    {
        return $this->hasMany(Follow::class);
    }
}
