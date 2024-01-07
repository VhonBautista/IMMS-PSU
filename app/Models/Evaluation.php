<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'matrix_id',
        'material_id',
        'evaluator_id',
        'passed_criteria',
        'comment',
        'status',
    ];

    public function matrix()
    {
        return $this->belongsTo(Matrix::class);
    }

    public function instructionalMaterial()
    {
        return $this->belongsTo(InstructionalMaterial::class, 'material_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
