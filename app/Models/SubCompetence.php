<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCompetence extends Model
{
    use HasFactory;

    public function competence_score()
    {
        return $this->hasMany(Competence_score::class);
    }
}
