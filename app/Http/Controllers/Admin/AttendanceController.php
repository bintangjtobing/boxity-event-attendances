<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\admin\AttendanceRepository;

class AttendanceController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new AttendanceRepository;
    }

    public function view()
    {
        $data['events'] = $this->repo->getEvent();
        $content = view('admin.attendance.view', $data);
        return view('admin.main', compact('content'));
    }

    public function addView()
    {
        $content = view('admin.attendance.add');
        return view('admin.main', ['content' => $content]);
    }

    public function editView($id)
    {
        $data['attendance'] = $this->repo->getSingleData($id);
        $content = view('admin.attendance.edit', $data);
        return view('admin.main', ['content' => $content]);
    }

    function data(Request $request)
    {
        $data['attendances'] = $this->repo->getData(10);
        return view('admin.attendance.data', $data);
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
}
