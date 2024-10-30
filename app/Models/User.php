<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'nisn',
        'nip',
        'birth',
        'classroom_id',
        'password',
        'role',
        'telp',
        'address',
        'image',
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

    public function classroom () {   
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function students()
    {
        return $this->hasMany(User::class)->where('role', 'student'); // Mengaitkan siswa
    }

    // public function toSearchableArray()
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'nisn' => $this->nisn,
    //         'nip' => $this->nip,
    //         'classroom_id' => $this->classroom_id, // Pastikan ini ada
    //         // Jika ingin menyertakan classroom_name, lakukan ini:
    //         'classroom_name' => $this->classroom ? $this->classroom->name : null,
    //     ];
    // }
}
