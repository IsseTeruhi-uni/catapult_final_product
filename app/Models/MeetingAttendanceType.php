<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingAttendanceType extends Model
{
    use HasFactory;

    public $timestamps = false; //  日付は無効にする

    // Constants
    const TYPE_YES = 1;
    const TYPE_NO = 2;
    const TYPE_NOT_YET = 99;
}
