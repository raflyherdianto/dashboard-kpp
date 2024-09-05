<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaportDetail extends Model
{
    use HasFactory;
    public function subEgi()
    {
        return $this->belongsTo(SubEgi::class, 'sub_egi_id');
    }
    public function competence()
    {
        return $this->belongsTo(Competence::class, 'competence_id');
    }
    public function subCompetence(){
        return $this->belongsTo(SubCompetence::class, 'sub_competence_id');
    }
}
