<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evidencija extends Model
{
    use HasFactory;

    protected $table = 'evidencija';

    protected $fillable = [
        'user_id',
        'task_id',
        'activity_type_id',
        'datum',
        'sati',
        'opis',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class);
    }
}
