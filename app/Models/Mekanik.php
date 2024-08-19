<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    use HasFactory;
    public function wali()
    {
        return $this->belongsTo(GlWali::class, 'gl_wali_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'mekanik_id');
    }
}
