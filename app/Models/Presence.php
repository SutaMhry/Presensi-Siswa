<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'image', 'date', 'check_in_time', 'information', 'latitude', 'longitude', 'location',];

    public function user () {   
        return $this->belongsTo(User::class);
    }

    public function attendancePermits () {   
        return $this->hasmany(Permit::class);
    }
}
