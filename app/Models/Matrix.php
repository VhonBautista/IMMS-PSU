<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matrix extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'matrix_name',
        'description',
        'level',
        'stage',
    ];
    
    public function subMatrices()
    {
        return $this->hasMany(SubMatrix::class, 'matrix_id');
    }
    
    public function evaluatorMatrices()
    {
        return $this->hasMany(EvaluatorMatrix::class, 'matrix_id');
    }
    
    public function evaluationStages()
    {
        return $this->hasMany(EvaluationStage::class, 'matrix_id');
    }
    
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'material_id');
    }
}
