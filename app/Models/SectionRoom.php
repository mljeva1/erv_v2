<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class SectionRoom extends Model
{
    /** @use HasFactory<\Database\Factories\SectionRoomFactory> */
    use HasFactory;

    protected $table = 'section_rooms';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}