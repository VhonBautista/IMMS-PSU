<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluatorMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'univ_role_id', 
        'matrix_id',
    ];

    public function evaluator() {
        return $this->belongsTo(UniversityRole::class, 'univ_role_id');
    }

    public function matrix() {
        return $this->belongsTo(Matrix::class, 'matrix_id');
    }
}
