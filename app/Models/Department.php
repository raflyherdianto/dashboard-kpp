<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function pelatihan()
    {
        return $this->hasMany(HistoryPelatihan::class, 'department_id');
    }

    public function raport()
    {
        return $this->hasMany(Raport::class, 'section_id');
    }
}
