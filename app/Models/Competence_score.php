<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence_score extends Model
{
    use HasFactory;

    public function subEgi()
    {
        return $this->belongsTo(SubEgi::class);
    }

    public function competenceSubCompetence()
    {
        return $this->belongsTo(CompetenceSubCompetence::class);
    }
}
