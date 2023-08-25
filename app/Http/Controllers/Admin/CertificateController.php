<?php

namespace App\Http\Controllers\Admin;

use App\Participants;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\admin\CertificateRepository;
use App\Repository\admin\SendCertificateRepository;

class CertificateController extends Controller
{
    protected $repo, $certificate;

    public function __construct()
    {
        $this->repo = new CertificateRepository;
        $this->certificate = new SendCertificateRepository;
    }

    public function viewCertificate($eventName, $participantName)
    {
        $pdfFilePath = public_path("certificates/{$eventName}-{$participantName}.pdf");
        if (file_exists($pdfFilePath)) {
            return response()->file($pdfFilePath);
        } else {
            return view('page.404');
        }
    }

    public function view()
    {
        $content = view('admin.certificates.view');
        return view('admin.main', compact('content'));
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
        if ($participant->email != null) {
            $this->certificate->sendCertificate($participant_id);
        }
        if ($participant->no_hp != null) {
            $data = [
                'participant_id' => $participant->participant_id,
                'phone_number' => $participant->no_hp
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

    public function downloadCertificate(Request $request) {
        $eventName = request('eventName');
        $participantName = request('participantName');
        $filename = $eventName . '-' . $participantName . '.pdf';
        $filePath = public_path('certificates/' . $filename);

        if (file_exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/pdf',
            ];
            return response()->download($filePath, $filename, $headers);
        } else {
            return response()->json(['error' => 'Certificate not found'], 404);
        }
    }

}
