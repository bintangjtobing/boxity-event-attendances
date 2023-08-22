<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\admin\AdminRepository;

class AdminController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new AdminRepository;
    }

    public function view()
    {
        $content = view('admin.admin.view');
        return view('admin.main', compact('content'));
    }

    public function addView()
    {
        $data['roles'] = $this->repo->getRoles();
        $content = view('admin.admin.add', $data);
        return view('admin.main', ['content' => $content]);
    }

    public function editView($id)
    {
        $data['roles'] = $this->repo->getRoles();
        $data['admin'] = $this->repo->getSingleData($id);
        $content = view('admin.admin.edit', $data);
        return view('admin.main', ['content' => $content]);
    }

    function data(Request $request)
    {
        $data['admins'] = $this->repo->getData(10);
        return view('admin.admin.data', $data);
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