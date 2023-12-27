<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCollege extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'college_id',
        'course_id',
        'created_at',
        'updated_at'
    ];

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
