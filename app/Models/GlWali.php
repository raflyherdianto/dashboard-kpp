<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlWali extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'wali_id');
    }

    public function mekaniks()
    {
        return $this->hasMany(Mekanik::class, 'gl_wali_id');
    }
}
