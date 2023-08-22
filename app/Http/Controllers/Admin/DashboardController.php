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
        $data['participant_total'] = $this->repo->getTotalParticipant();
        $data['now'] = $this->repo->getDateNow();
        $data['time_of_day'] = $this->repo->getTimeOfDay();
        $content = view('admin.dashboard.view', $data);
        return view('admin.main', compact('content'));
    }
}
