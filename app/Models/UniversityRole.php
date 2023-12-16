<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityRole extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'university_role',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
