<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;
    // protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function wali()
    {
        return $this->hasMany(GlWali::class, 'wali_id');
    }

    public function mekanik()
    {
        return $this->hasMany(Mekanik::class, 'mekanik_id');
    }

    public function user_mekanik()
    {
        return $this->hasMany(HistoryPelatihan::class, 'mekanik_id');
    }

    public function instruktur()
    {
        return $this->hasMany(HistoryPelatihan::class, 'instruktur_id');
    }
}
