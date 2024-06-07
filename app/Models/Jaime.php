<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jaime extends Model
{
    use HasFactory;

public function user()
{
    return $this->belongsToMany(User::class);
}
public function task()
    {
        return $this->belongsTo(Task::class);
    }

}
