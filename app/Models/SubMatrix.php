<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMatrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'matrix_id',
    ];

    public function matrixItems() {
        return $this->hasMany(MatrixItem::class, 'sub_matrix_id');
    }
    
    public function matrix() {
        return $this->belongsTo(Matrix::class, 'matrix_id');
    }
}
