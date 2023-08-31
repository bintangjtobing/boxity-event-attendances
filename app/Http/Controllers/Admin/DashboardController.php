<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\admin\DashboardRepository;

class DashboardController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new DashboardRepository;
    }

    public function view()
    {
        $data['event_total'] = $this->repo->getTotalEvent();
        $data['event_active'] = $this->repo->getTotalEventActive();
        $data['participant_total'] = $this->repo->getTotalParticipant();
        $data['participant_hadir'] = $this->repo->getTotalParticipantHadir();
        $data['participant_hadir_now'] = $this->repo->getTotalParticipantHadirNow();
        $data['now'] = $this->repo->getDateNow();
        $data['time_of_day'] = $this->repo->getTimeOfDay();
        $content = view('admin.dashboard.view', $data);
        return view('admin.main', compact('content'));
    }
}
