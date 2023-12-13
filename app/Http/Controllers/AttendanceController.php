<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\AttendanceRepository;

class AttendanceController extends Controller
{
    protected $repo;

    function __construct() {
        $this->repo = new AttendanceRepository;
    }

    function view() {
        $data['event'] = $this->repo->getSingleEvent();
        return view('attendance', $data);
    }
}