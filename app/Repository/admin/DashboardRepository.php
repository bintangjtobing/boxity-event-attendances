<?php

namespace App\Repository\admin;

use App\Events;
use App\Participants;
use Exception;
use Carbon\Carbon;

class DashboardRepository
{
    public function getTotalEvent() {
        $total = Events::count();
        return $total;
    }

    public function getTotalEventActive() {
        $total = Events::where('status', 'active')->count();
        return $total;
    }

    public function getTotalParticipant()
    {
        $total = Participants::count();
        return $total;
    }

    public function getTotalParticipantHadir() {
        $total = Participants::whereHas('Attendance')->count();
        return $total;
    }

    public function getTotalParticipantHadirNow() {
        $total = Participants::whereHas('Attendance', function($query) {
            $query->where('attendance_date', Carbon::now()->format('Y-m-d'));
        })->count();
        return $total;
    }

    public function getDateNow()
    {
        $now = Carbon::now('Asia/Jakarta');
        return $now;
    }

    public function getTimeOfDay()
    {
        $now = Carbon::now('Asia/Jakarta');
        $hour = $now->hour;

        if ($hour >= 5 && $hour < 12) {
            $timeOfDay = "Morning";
        } elseif ($hour >= 12 && $hour < 15) {
            $timeOfDay = "Afternoon";
        } elseif ($hour >= 15 && $hour < 18) {
            $timeOfDay = "Evening";
        } else {
            $timeOfDay = "Night";
        }

        return $timeOfDay;
    }
}