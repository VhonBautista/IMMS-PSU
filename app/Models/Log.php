<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'area',
        'title',
        'action',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
