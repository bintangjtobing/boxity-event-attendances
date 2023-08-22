<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\admin\AuthorizationRepository;

class AuthorizationController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new AuthorizationRepository;
    }

    public function view()
    {
        $data['menu'] = $this->repo->getMenu();
        $data['type'] = $this->repo->getType();
        $data['role'] = $this->repo->getRole();
        $data['authorization'] = $this->repo->getData($data['role'][0]->id);
        $content = view('admin.authorization.view', $data);
        return view('admin.main', compact('content'));
    }

    function data($id){
        $data['menu'] = $this->repo->getMenu();
        $data['type'] = $this->repo->getType();
        $data['role'] = $this->repo->getRole();
        $data['authorization'] = $this->repo->getData($id);
        return view('admin.authorization.data', $data);
    }

    function update(Request $request){
        DB::beginTransaction();
        try {
            $data = $this->repo->update();
            DB::commit();
        } catch (\Exception $exception) {
            // return redirect()->route('authorization_view_data')->withInput($request->input())->withErrors("Something Wrong");
            return response([
                'status' => false,
                'message' => $exception
            ]);
        }
    }
}
