<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use HasFactory;

    public function mekanik()
    {
        return $this->belongsTo(User::class, 'mekanik_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function section()
    {
        return $this->belongsTo(Department::class, 'section_id');
    }
}
