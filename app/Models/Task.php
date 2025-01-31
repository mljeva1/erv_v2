<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_code',
        'task_name',
        'task_description',
        'work_time',
        'company_profile_id',
        'activity_type_id',
        'task_status_id',
        'task_date'
    ];

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function companyProfile()
    {
        return $this->belongsTo(CompanyProfile::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id')->withTimestamps();
    }
}
