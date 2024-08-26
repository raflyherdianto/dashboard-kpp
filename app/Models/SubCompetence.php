<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCompetence extends Model
{
    use HasFactory;

    public function competence_sub_competences()
    {
        return $this->hasMany(CompetenceSubCompetence::class);
    }
}
