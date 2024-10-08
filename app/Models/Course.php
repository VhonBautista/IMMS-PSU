<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'course_name',
        'campus_id',
    ];
    
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function colleges()
    {
        return $this->belongsToMany(Course::class, 'course_colleges');
    }
    
    public function instructionalMaterials()
    {
        return $this->hasMany(InstructionalMaterial::class, 'submitter_id');
    }
}
