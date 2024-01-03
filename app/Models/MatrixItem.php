<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrixItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item', 
        'text', 
        'sub_matrix_id',
    ];

    public function subMatrix() {
        return $this->belongsTo(SubMatrix::class, 'sub_matrix_id');
    }
}
