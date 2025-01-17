<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'description',
        'partnership_start_at',
        'partnership_updated_at',
        'partnership_ended',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
