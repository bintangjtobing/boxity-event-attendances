<?php

namespace App\Repository\admin;

use Exception;
use App\Certificates;
use App\Participants;
use App\Helper\Helper;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Hash;

class CertificateRepository
{
    function getSingleData($id) {
        $data = Certificates::with(['Participant', 'Event'])->find($id);
        return $data;
    }

    function getData($n) {
        $search = request('search');
        $data = Certificates::with(['Participant', 'Event'])->orderBy('id', 'desc');
        if ($search) {
            $data = $data->whereHas('Participant', function($query) use($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        return $data->paginate($n);
    }

    function updateStatus($participant_id) {
        $data = [
            'status' => 1,
        ];
        $certificate = Certificates::where('participant_id',$participant_id)->where('status', 0)->first();
        if ($certificate) {
            $certificate->update($data);
        }
    }

    function delete($id) {
        Certificates::where('id', $id)->delete();
    }

    public function getPathFile()
    {
        $qr_code = request('qr_code');
        $participant = Participants::where('qr_code', $qr_code)->first();
        $nama = $participant->name;
        $token = $participant->qr_code;
        $qr_code_path = public_path('images/certificate/qr-code/img-' . $token . '.png');
        $filename = 'SERTIFIKAT.pdf';
        $certificatename = $participant->Event->name . '-' . $nama . '.pdf';
        $outputFolder = public_path('certificates'); // Folder tujuan
        $outputfile = $outputFolder . '/' . $certificatename;

        // Buat folder jika belum ada
        if (!file_exists($outputFolder)) {
            mkdir($outputFolder, 0777, true);
        }

        // Coba menyimpan sertifikat
        $success = $this->fillPDF(public_path() . "/template/certificate/" . $filename, $outputfile, $nama, $token, $qr_code_path);
        $message = [
            'status' => true,
            'message' => 'Successfully saved'
        ];
        return $message;
    }


    public function fillPDF($file, $outputfile, $nama, $token, $path_qr) {
        $fpdi = new FPDI();

        // Hitung jumlah halaman dalam PDF sumber
        $pageCount = $fpdi->setSourceFile($file);
        for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
            $template = $fpdi->importPage($pageNumber);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $fpdi->useTemplate($template);

            // Tambahkan Nama di Tengah Halaman
            $name = $nama;
            $fpdi->SetFont("helvetica", "", 30);
            $fpdi->SetTextColor(25, 26, 25);
            $textWidth = $fpdi->GetStringWidth($name);
            $centerX = ($size['width'] - $textWidth) / 2;
            $centerY = ($size['height'] / 2 - 15);
            $fpdi->Text($centerX, $centerY, $name);

            // Tambahkan Token di Bagian Bawah Kiri
            $tokenText = $token;
            $fpdi->SetFont("helvetica", "", 10);
            $fpdi->SetTextColor(25, 26, 25);
            $fpdi->Text(10, $size['height'] - 10, $tokenText);

            $qrSize = 40;
            $qrX = ($size['width'] - $qrSize) / 2 +10;
            $qrY = ($size['height'] / 2) + 50;
            $fpdi->Image($path_qr, $qrX, $qrY, $qrSize, $qrSize);
        }

        return $fpdi->Output($outputfile, 'F');
    }

    function checkCertificate($token) {
        $participant = Participants::where('qr_code', $token)->first();
        $check = Certificates::where('participant_id', $participant->participant_id)->first();
        if ($check) {
            return  [
                'name' => $participant->name,
                'message' => 'Sudah Tervalidasi',
                'token' => $participant->qr_code
            ];
        }
        return [
            'status' => false,
            'message' => 'Certificate not found.'
        ];
    }
}
