<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPelatihan extends Model
{
    use HasFactory;

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }
    public function mekanik()
    {
        return $this->belongsTo(User::class, 'mekanik_id');
    }

    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function subEgi()
    {
        return $this->belongsTo(SubEgi::class);
    }
}
