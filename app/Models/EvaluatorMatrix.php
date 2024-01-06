<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluatorMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluator_id', 
        'matrix_id',
    ];

    public function evaluator() {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    public function matrix() {
        return $this->belongsTo(Matrix::class, 'matrix_id');
    }
}
