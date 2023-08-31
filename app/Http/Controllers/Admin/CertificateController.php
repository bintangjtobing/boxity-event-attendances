<?php

namespace App\Http\Controllers\Admin;

use App\Attendances;
use App\Participants;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\admin\CertificateRepository;
use App\Repository\admin\SendCertificateRepository;

class CertificateController extends Controller
{
    protected $repo, $certificate, $sertifikat;

    public function __construct()
    {
        $this->repo = new CertificateRepository;
        $this->certificate = new SendCertificateRepository;
        $this->sertifikat = new CertificateRepository;
    }

    public function viewCertificate($eventName, $qr_code)
    {
        $participant = Participants::where('qr_code', $qr_code)->first();
        $participantName = $participant->name;
        $pdfFilePath = public_path("certificates/{$eventName}-{$participantName}.pdf");
        if (file_exists($pdfFilePath)) {
            return response()->file($pdfFilePath);
        } else {
            $newpdfFilePath = public_path("certificates/new/{$eventName}-{$participantName}.pdf");
            if (file_exists($newpdfFilePath)) {
                return response()->file($newpdfFilePath);
            } else {
                return view('page.404');
            }
        }
    }

    public function view()
    {
        $content = view('admin.certificates.view');
        return view('admin.main', compact('content'));
    }

    public function verificationCertificate($token)
    {
        $check = $this->repo->checkCertificate($token);
        return view('validation', compact('check'));
    }

    function data(Request $request)
    {
        $data['certificates'] = $this->repo->getData(10);
        return view('admin.certificates.data', $data);
    }

    public function sendCertificate(Request $request) {
        $participant_id = request('participant_id');
        $participant = Participants::where('participant_id', $participant_id)->first();
        if (!$participant) {
            $message = [
                'status' => false,
                'message' => 'Participant not found.'
            ];
            return $message;
        }
        // save qrcode sertifikat
        $this->certificate->saveQrCodeCertificate($participant->qr_code);
        //save sertifikat
        $save = $save_certificate = $this->sertifikat->getPathFile();
        if ($participant->email != null) {
            $datas = [
                'status' => true,
                'message' => 'Attendance success',
                'name' => $participant->name,
                'event' => $participant->Event->name,
                'email' => $participant->email,
                'no_hp' => $participant->no_hp,
                'participant_id' => $participant->participant_id,
                'event_id' => $participant->Event->id,
                'start_date' => $participant->Event->start_date,
                'start_time' => $participant->Event->start_time,
                'end_time' => $participant->Event->end_time,
                'location' => $participant->Event->location,
                'ukuran_baju' => $participant->ukuran_baju ?? 'All Size',
                'token' => $participant->qr_code,
                'qr_code' => $participant->qr_code
            ];
            $this->certificate->sendCertificate($datas);
        }
        if ($participant->no_hp != null) {
            $data = [
                'name' => $participant->name,
                'event' => $participant->Event->name,
                'start_date' => $participant->Event->start_date,
                'participant_id' => $participant->participant_id,
                'no_hp' => $participant->no_hp,
                'qr_code' => $participant->qr_code
            ];
            $this->certificate->sendCertificateToWa($data);
        }
        $this->repo->updateStatus($participant_id);
        $message = [
            'status' => true,
            'message' => 'The certificate has been successfully sent.'
        ];
        return $message;
    }

    public function sendCertificateToAll(Request $request) {
        $data = Participants::whereHas('Attendance')->get();
        foreach ($data as $i) {
            $participant = Participants::where('participant_id', $i->participant_id)->first();
            if (!$participant) {
                $message = [
                    'status' => false,
                    'message' => 'Participant not found.'
                ];
                return $message;
            }
            // save qrcode sertifikat
            $this->certificate->saveQrCodeCertificate($participant->qr_code);
            //save sertifikat
            $save = $save_certificate = $this->sertifikat->getPathFile($participant->participant_id);
            if ($participant->email != null) {
                $datas = [
                    'status' => true,
                    'message' => 'Attendance success',
                    'name' => $participant->name,
                    'event' => $participant->Event->name,
                    'email' => $participant->email,
                    'no_hp' => $participant->no_hp,
                    'participant_id' => $participant->participant_id,
                    'event_id' => $participant->Event->id,
                    'start_date' => $participant->Event->start_date,
                    'start_time' => $participant->Event->start_time,
                    'end_time' => $participant->Event->end_time,
                    'location' => $participant->Event->location,
                    'ukuran_baju' => $participant->ukuran_baju ?? 'All Size',
                    'token' => $participant->qr_code
                ];
                $this->certificate->sendCertificate($datas);
            }
            if ($participant->no_hp != null) {
                $data = [
                    'name' => $participant->name,
                    'event' => $participant->Event->name,
                    'start_date' => $participant->Event->start_date,
                    'participant_id' => $participant->participant_id,
                    'no_hp' => $participant->no_hp,
                    'qr_code' => $participant->qr_code
                ];
                $this->certificate->sendCertificateToWa($data);
            }
            $this->repo->updateStatus($participant->participant_id);
            $message = [
                'status' => true,
                'message' => 'The certificate has been successfully sent.'
            ];
            return $message;
        }
    }

    public function downloadCertificate(Request $request) {
        $eventName = request('eventName');
        $participant = Participants::where('qr_code', request('qr_code'))->first();
        $qr_code = $participant->qr_code;
        $participantName = $participant->name;
        $filename = $eventName . '-' . $qr_code . '.pdf';
        $filePath = public_path('certificates/' . $filename);
        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            $newfilePath = public_path('certificates/new/' . $filename);
            if (file_exists($newfilePath)) {
                $headers = [
                    'Content-Type' => 'application/pdf',
                ];
                return response()->download($filePath, $filename, $headers);
            } else {
                return response()->json(['error' => 'Certificate not found'], 404);
            }
        }
    }

}
