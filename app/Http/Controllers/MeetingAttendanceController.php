<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\MeetingAttendanceType;
use Illuminate\Http\Request;

class MeetingAttendanceController extends Controller
{
    public function create(Meeting $meeting)
    {
        $grouped_attendances = $meeting->attendances->groupBy('type_id');
        $attendance_types = MeetingAttendanceType::pluck('name', 'id');

        return view('meeting_attendance.create')->with([
            'meeting' => $meeting,
            'grouped_attendances' => $grouped_attendances,
            'attendance_types' => $attendance_types
        ]);
    }

    public function update(Meeting $meeting, Request $request)
    {
        // バリデーションは割愛します

        $result = false;
        $user_id = auth()->id();
        $attendance = MeetingAttendance::where('meeting_id', $meeting->id)
            ->where('user_id', $user_id)
            ->first();

        if (!is_null($attendance)) {

            $attendance->type_id = $request->type_id;
            $result = $attendance->save();
        }

        return redirect()->route('meeting.index');
    }
}
