<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'campus_name',
        'location',
    ];

    public function colleges()
    {
        return $this->hasMany(College::class);
    }
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
    
    public function instructionalMaterials()
    {
        return $this->hasMany(InstructionalMaterial::class, 'submitter_id');
    }
}
