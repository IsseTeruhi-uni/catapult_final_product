<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingAttendance extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(MeetingAttendanceType::class, 'type_id', 'id');
    }
}
