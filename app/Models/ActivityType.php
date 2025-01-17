<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
