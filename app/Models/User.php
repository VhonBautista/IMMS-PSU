<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'email',
        'password',
        'role_id',
        'univ_role_id',
        'campus_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function universityRole()
    {
        return $this->belongsTo(UniversityRole::class, 'univ_role_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
    
    public function instructionalMaterials()
    {
        return $this->hasMany(InstructionalMaterial::class, 'submitter_id');
    }
    
    public function evaluatorMatrix()
    {
        return $this->hasOne(EvaluatorMatrix::class, 'evaluator_id');
    }
    
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'material_id');
    }
}
