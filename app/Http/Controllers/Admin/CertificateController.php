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
        // Lakukan apa yang perlu Anda lakukan untuk menampilkan atau memberikan file PDF
        // Anda dapat mengambil data berdasarkan $eventName dan $participantName
        // Dan kemudian merujuk ke file PDF yang sesuai

        $pdfFilePath = public_path("certificates/{$eventName}-{$participantName}.pdf");

        // Lakukan validasi apakah file ada atau tidak
        if (file_exists($pdfFilePath)) {
            // Lakukan sesuatu dengan file PDF, misalnya memunculkan pesan atau mengunduhnya
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

    public function getPathFile(Request $request) {
        $participant_id = request('participant_id');
        $participant = Participants::where('participant_id', $participant_id)->first();
        $nama = $participant->name;
        $filename = 'SERTIFIKAT.pdf';
        $certificatename = $participant->Event->name . '-' . $nama . '.pdf';
        $outputFolder = public_path('certificates'); // Folder tujuan
        $outputfile = $outputFolder . '/' . $certificatename;

        // Buat folder jika belum ada
        if (!file_exists($outputFolder)) {
            mkdir($outputFolder, 0777, true);
        }

        $this->fillPDF(public_path() . "/template/certificate/" . $filename, $outputfile, $nama);
        // Force download the PDF file
        return $outputfile;
    }


    public function fillPDF($file, $outputfile, $nama) {
        $fpdi = new FPDI();

        // Hitung jumlah halaman dalam PDF sumber
        $pageCount = $fpdi->setSourceFile($file);

        for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
            $template = $fpdi->importPage($pageNumber);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $fpdi->useTemplate($template);

            $name = $nama;

            $fpdi->SetFont("helvetica", "", 30);
            $fpdi->SetTextColor(25, 26, 25);

            $textWidth = $fpdi->GetStringWidth($name);
            $centerX = ($size['width'] - $textWidth) / 2;
            $centerY = ($size['height'] / 2) + 5;

            $fpdi->Text($centerX, $centerY, $name);
        }

        return $fpdi->Output($outputfile, 'F');
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
