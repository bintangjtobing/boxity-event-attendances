<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Admins;
use Illuminate\Http\Request;
use App\Repository\AuthRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\admin\SendCertificateRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $attendance, $certificate;

    function __construct() {
        $this->attendance = new AuthRepository;
        $this->certificate = new SendCertificateRepository;
    }

    function viewLogin() {
        return view('admin.login');
    }

    function processLogin(Request $request) {
        $email = request('email');
        $password = request('password');
        $timezone = 'Asia/Jakarta';
        $now = \Carbon\Carbon::now($timezone);
        $admin = Admins::whereHas('Role', function($query) {
            $query->where('type', 2);
        });
        if (str_contains($request->email_or_username, '@')) {
            $admin = $admin->where('email', $request->email_or_username)->first();
        } else {
            $admin = $admin->where('username', $request->email_or_username)->first();
        }

        if ($admin) {
            if (Hash::check($password, $admin->password)) {
                Auth::guard('admin')->login($admin);
                $message = [
                    'status' => true,
                    'success' => 'Login Success'
                ];
                return response()->json($message);
            } else {
                $message = [
                    'status' => false,
                    'error' => 'Password Missmatch'
                ];
                return response()->json($message);
            }
        } else {
            $message = [
                'status' => false,
                'error' => 'Username or Email Not Found'
            ];
            return response()->json($message);
        }
    }

    function processLogout() {
        Auth::guard('admin')->logout();
        return view('admin.login');
    }

    function processAttendance(Request $request) {
        DB::beginTransaction();
        try {
            $check = $this->attendance->scanAttendances();
            if ($check['status'] == true) {
                if ($check['email'] != null) {
                    $this->certificate->sendCertificate($check['participant_id']);
                }
                if ($check['phone_number'] != null) {
                    $this->certificate->sendCertificateToWa($check);
                }
                DB::commit();
                $message = [
                    'status' => true,
                    'message' => $check['message'],
                    'name' => $check['name'],
                    'event' => $check['event'],
                    'time' => $check['time'],
                    'date' => $check['date'],
                    'location' => $check['location']
                ];
            } else {
                $message = [
                    'status' => false,
                    'error' => $check['message']
                ];
            }

        } catch (\Exception $exception) {
            DB::rollback();
            $message = [
                'status' => false,
                'error' => $exception->getMessage()
            ];
        }
        return response()->json($message);
    }
}
