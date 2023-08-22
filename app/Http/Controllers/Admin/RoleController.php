<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\admin\RoleRepository;

class RoleController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new RoleRepository;
    }

    public function view()
    {
        $content = view('admin.role.view');
        return view('admin.main', compact('content'));
    }

    public function addView()
    {
        $content = view('admin.role.add');
        return view('admin.main', ['content' => $content]);
    }

    public function editView($id)
    {
        $data['role'] = $this->repo->getSingleData($id);
        $content = view('admin.role.edit', $data);
        return view('admin.main', ['content' => $content]);
    }

    function data(Request $request)
    {
        $data['roles'] = $this->repo->getData(10);
        return view('admin.role.data', $data);
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