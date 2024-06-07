<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'detail',
        'image_path',
        'category',
        'status'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function jaimes()
    {
        return $this->hasMany(Jaime::class);
    }
    public function likedBy(User $user)
    {
        return $this->jaimes()->where('user_id', $user->id)->exists();
    }
}
