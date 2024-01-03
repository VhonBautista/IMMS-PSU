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
    ];
    
    public function subMatrices() {
        return $this->hasMany(SubMatrix::class, 'matrix_id');
    }
    
    public function evaluatorMatrices() {
        return $this->hasMany(EvaluatorMatrix::class, 'matrix_id');
    }
}
