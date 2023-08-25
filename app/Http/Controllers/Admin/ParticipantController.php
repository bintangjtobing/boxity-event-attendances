<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\ParticipantImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Repository\admin\SendQrRepository;
use App\Repository\admin\ParticipantRepository;
use App\Repository\admin\SendCertificateRepository;

class ParticipantController extends Controller
{
    protected $repo, $qr_code, $certificate;

    public function __construct()
    {
        $this->repo = new ParticipantRepository;
        $this->qr_code = new SendQrRepository;
        $this->certificate = new SendCertificateRepository;
    }

    public function view()
    {
        $data['events'] = $this->repo->getEvent();
        $content = view('admin.participant.view', $data);
        return view('admin.main', compact('content'));
    }

    public function addView()
    {
        $data['events'] = $this->repo->getEvent();
        $content = view('admin.participant.add', $data);
        return view('admin.main', ['content' => $content]);
    }

    public function editView($id)
    {
        $data['participant'] = $this->repo->getSingleData($id);
        $content = view('admin.participant.edit', $data);
        return view('admin.main', ['content' => $content]);
    }

    function data(Request $request)
    {
        $data['participants'] = $this->repo->getData(10);
        return view('admin.participant.data', $data);
    }

    function addPost(Request $request) {
        DB::beginTransaction();
        try {
            $data = $this->repo->add();
            if($data['status'] == true) {
                if ($data['email'] != null) {
                    $this->qr_code->sendQrCode($data['token']);
                    $this->certificate->sendCertificate($data['email']);
                }
                if ($data['phone_number'] != null) {
                    $this->qr_code->sendQrCodeToWa($data);
                    $this->certificate->sendCertificateToWa($data);
                }
                DB::commit();
                $message = [
                    'status' => true,
                ];
            } else {
                DB::rollback();
                $message = [
                    'status' => false,
                    'error' => $data['error']
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

    function import(Request $request)
    {
        $data = Excel::toCollection(new ParticipantImport, request('upload-1'));
        $arr = [];
        foreach ($data[0] as $key => $i) {
            if ($key == 0) {
                continue;
            }
            $arr[] = [
                'created_at' => Carbon::createFromDate(1900, 1, 1)->addDays((int)trim($i[1]) - 2)->format('Y-m-d'),
                'event_id' => request('event_id'),
                'nama' => trim($i[2]),
                'jabatan' => trim($i[3]),
                'no_hp' => trim($i[12]),
                'instansi' => trim($i[4]),
                'alamat_instansi' => trim($i[5]),
                'tanggal_kedatangan' => Carbon::createFromDate(1900, 1, 1)->addDays((int)trim($i[6]) - 2)->format('Y-m-d'),
                'penginapan' => trim($i[8]),
                'tanggal_kembali' => Carbon::createFromDate(1900, 1, 1)->addDays((int)trim($i[9]) - 2)->format('Y-m-d'),
            ];
        }
        DB::beginTransaction();
        try {
            $data = $this->repo->import($arr);
            DB::commit();
            return response([
                'status' => true,
                'message' => 'Import Success',
            ]);
        } catch (\Exception $exception) {
            DB::rollback();
            return response([
                'status' => false,
                'message' => 'Import Failed',
                'data' => $exception->getMessage()
            ]);
        }
    }

    public function downloadTemplate()
    {
        $file = public_path('template/import-participant.xlsx');
        $filename = 'import-participant.xlsx';

        return response()->download($file, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
