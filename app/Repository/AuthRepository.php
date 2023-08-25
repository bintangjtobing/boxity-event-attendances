<?php

namespace App\Repository;

use Exception;
use Carbon\Carbon;
use App\Events;
use App\AdminStyles;
use App\Attendances;
use App\Certificates;
use App\Participants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class AuthRepository
{
    function scanAttendances() {
        $timezone = 'Asia/Jakarta';
        $data = Participants::where('qr_code', request('qr_code'))->first();
        //check event ada atau tidak
        if (!$data) {
            return [
                'status' => false,
                'message' => 'Event not found'
            ];
        }
        $currentDatetime = Carbon::now($timezone)->format('Y-m-d');
        $event = $data->Event;
        $event_start = Carbon::parse($event->start_date . ' ' . $event->start_time)->format('Y-m-d'); // 2023-07-13 20:30:00
        $event_ended = Carbon::parse($event->end_date . ' ' . $event->end_time)->format('Y-m-d');
        //check event sudah lewat harinya atau belum
        if ($event_ended < $currentDatetime) {
            return [
                'status' => false,
                'message' => 'Event has passed'
            ];
        }
        //check event sudah mulai atau belum
        if ($event_start > $currentDatetime) {
            return [
                'status' => false,
                'message' => 'Event has not started yet'
            ];
        }
        //check peserta sudah checkin atau belum
        $attendance = Attendances::where('participant_id', $data->participant_id)->where('event_id', $data->event_id)->whereDate('attendance_date', Carbon::now($timezone))->get();
        if (count($attendance) > 0) {
            return [
                'status' => false,
                'message' => 'Participant has checkin'
            ];
        }

        $attendances = Attendances::create([
            'participant_id' => $data->participant_id,
            'event_id' => $data->event_id,
            'attendance_date' => Carbon::now($timezone),
            'attendance_time' => Carbon::now($timezone)->format('H:i:s'),
            'status' => true,
        ]);

        $status = 0;
        $data_certificate = [
            'participant_id' => $data->participant_id,
            'event_id' => $data->event_id,
            'status' => $status
        ];

        Certificates::create($data_certificate);
        return [
            'status' => true,
            'message' => 'Attendance success',
            'name' => $data->name,
            'event' => $data->Event->name,
            'time' => $attendances->attendance_time,
            'date' => Carbon::parse($attendances->attendance_date)->isoFormat('D MMMM Y'),
            'location' => $attendances->Event->location,
            'email' => $data->email,
            'phone_number' => $data->no_hp,
            'participant_id' => $data->participant_id,
            'event_id' => $event->id,
            'start_date' => $event->start_date,
            'start_time' => $event->start_time,
            'end_time' => $event->end_time,
            'location' => $event->location
        ];
    }
}
