<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nim',
        'noHP',
        'email',
        'institusi',
        'fakultas',
        'jurusan',
        'judul',
        'waktu_mulai',
        'waktu_selesai',
        'rekomendasi',
        'surat',
        'bidang',
        'status',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isWithinDateRange()
    {
        $currentDate = now();
        $startDate = $this->waktu_mulai;
        $endDate = $this->waktu_selesai;

        return $currentDate >= $startDate && $currentDate <= $endDate;
    }

    public function isPastEndDate()
    {
        $currentDate = now();
        $endDate = $this->waktu_selesai;

        return $currentDate > $endDate;
    }
}