<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEgi extends Model
{
    use HasFactory;

    public function egi()
    {
        return $this->belongsTo(Egi::class);
    }

    public function competence_score(){
        return $this->hasMany(Competence_score::class);
    }
}
