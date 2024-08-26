<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenceSubCompetence extends Model
{
    use HasFactory;

    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    public function subCompetence(){
        return $this->belongsTo(SubCompetence::class);
    }

    public function competenceScore()
    {
        return $this->hasMany(Competence_score::class);
    }
}
