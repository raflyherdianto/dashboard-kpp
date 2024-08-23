<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    public function egi()
    {
        return $this->belongsTo(Egi::class);
    }

    public function competence_sub_competences()
    {
        return $this->hasMany(CompetenceSubCompetence::class);
    }
}
