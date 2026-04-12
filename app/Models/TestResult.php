<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;
    
    // Izinkan kolom baru untuk diisi
    protected $fillable = [
        'user_id', 
        'fullname',    // <-- BARU
        'class_grade', // <-- BARU
        'result_code', 
        'result_name', 
        'scores'
    ];

    protected $casts = [
        'scores' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}