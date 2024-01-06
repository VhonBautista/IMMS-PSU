<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationStage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'matrix_id',
        'material_id',
    ];

    public function matrix()
    {
        return $this->belongsTo(Matrix::class, 'matrix_id');
    }

    public function instructionalMaterial()
    {
        return $this->belongsTo(InstructionalMaterial::class, 'material_id');
    }
}
