<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date-permit', 'type-permit', 'reason', 'permit-file', 'latitude', 'longitude', 'information'];

    public function user () {   
        return $this->belongsTo(User::class);
    }

    public function presence () {   
        return $this->belongsTo(Presence::class);
    }
}
