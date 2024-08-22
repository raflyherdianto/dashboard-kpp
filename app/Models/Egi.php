<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egi extends Model
{
    use HasFactory;

    public function competences(){
        return $this->hasMany(Competence::class);
    }
    
}
