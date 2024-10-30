<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hmteacher_id'];

    public function users() {   
        return $this->hasmany(User::class);
    }

    public function hmteacher()
    {
        return $this->belongsTo(User::class, 'hmteacher_id'); 
    }

    public function students()
    {
        return $this->hasMany(User::class)->where('role', 'student');
    }

}
