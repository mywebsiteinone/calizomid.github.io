<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'status', 'del'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user() // Add relationship to User
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        // Format the date to "F j, Y" (e.g., "October 25, 2024")
        return \Carbon\Carbon::parse($value)->format('F j, Y');
    }
}
