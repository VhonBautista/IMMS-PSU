<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructionalMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pdf_path',
        'proponents',
        'course_id',
        'department_id',
        'campus_id',
        'submitter_id',
        'type',
        'status',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'submitter_id');
    }
}
