<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;

    public function historyPelatihan()
    {
        return $this->hasMany(HistoryPelatihan::class, 'pelatihan_id');
    }
}
