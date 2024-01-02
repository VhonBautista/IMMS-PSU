<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    
    protected $fillable = [
        
        'college_name',
        'description',
        'campus_id',
        'description'
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_colleges');
    }
}
