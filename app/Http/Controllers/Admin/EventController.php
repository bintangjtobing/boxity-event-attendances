<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\admin\EventRepository;
use App\Repository\admin\SendQrRepository;

class EventController extends Controller
{
    protected $repo, $qr_code;

    public function __construct()
    {
        $this->repo = new EventRepository;
        $this->qr_code = new SendQrRepository;
    }

    public function view()
    {
        $content = view('admin.event.view');
        return view('admin.main', compact('content'));
    }

    public function addView()
    {
        $content = view('admin.event.add');
        return view('admin.main', ['content' => $content]);
    }

    public function editView($id)
    {
        $data['event'] = $this->repo->getSingleData($id);
        $content = view('admin.event.edit', $data);
        return view('admin.main', ['content' => $content]);
    }

    function data(Request $request)
    {
        $data['events'] = $this->repo->getData(10);
        return view('admin.event.data', $data);
    }

    function addPost(Request $request) {
        DB::beginTransaction();
        try {
            $data = $this->repo->add();
            DB::commit();
            $message = [
                'status' => true,
            ];
        } catch (\Exception $exception) {
            DB::rollback();
            $message = [
                'status' => false,
                'error' => $exception->getMessage()
            ];
        }
        return response()->json($message);
    }

    function update(Request $request, $id){
        DB::beginTransaction();
        try {
            $data = $this->repo->update($id);
            DB::commit();
            $message = [
                'status' => true,
            ];
        } catch (\Exception $exception) {
            DB::rollback();
            $message = [
                'status' => false,
                'error' => $exception->getMessage()
            ];
        }
        return response()->json($message);
    }

    function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->repo->delete($id);
            DB::commit();
            $message = [
                'status' => true
            ];
        } catch (\Exception $exception) {
            DB::rollback();
            $message = [
                'status' => false,
                'error' => "Something Wrong"
            ];
        }
        return response()->json($message);
    }

    public function register($token)
    {
        $data['event'] = $this->repo->getSingleEvent($token);

        if (!$data['event']) {
            return view('admin.event.register.not_found');
        }
        if ($data['event']->status == 'inactive') {
            return view('admin.event.register.inactive');

        }
        $timezone = 'Asia/Jakarta';
        $currentTime = \Carbon\Carbon::now($timezone);
        $currentDate = \Carbon\Carbon::now($timezone)->format('Y-m-d');

        if (\Carbon\Carbon::parse($data['event']->start_date) < $currentDate) {
            return view('admin.event.register.expired');
        }

        $datetime_event = \Carbon\Carbon::parse($data['event']->start_date . ' ' . $data['event']->start_time);
        if ($datetime_event->format('Y-m-d H:i:s') < $currentTime->format('Y-m-d H:i:s')) {
            return view('admin.event.register.has_started');
        }


        return view('admin.event.register.register', $data);
    }

    public function processRegistration(Request $request, $token)
    {
        DB::beginTransaction();
        try {
            $check = $this->repo->processRegister($token);
            if ($check['status'] == true) {
                $this->qr_code->sendQrCode($check['token']);
                DB::commit();
                $message = [
                    'status' => true,
                    'message' => $check['message']
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
