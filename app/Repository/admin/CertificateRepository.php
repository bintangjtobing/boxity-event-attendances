<?php

namespace App\Repository\admin;

use Exception;
use App\Certificates;
use App\Participants;
use setasign\Fpdi\Fpdi;

class CertificateRepository
{
    function getSingleData($id) {
        $data = Certificates::with(['Participant', 'Event'])->find($id);
        return $data;
    }

    function getData($n) {
        $data = Certificates::with(['Participant', 'Event'])->orderBy('id', 'asc');
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
        $filename = 'SERTIFIKAT.pdf';
        $certificatename = $participant->Event->name . '-' . $nama . '.pdf';
        $outputFolder = public_path('certificates'); // Folder tujuan
        $outputfile = $outputFolder . '/' . $certificatename;

        // Buat folder jika belum ada
        if (!file_exists($outputFolder)) {
            mkdir($outputFolder, 0777, true);
        }

        // Coba menyimpan sertifikat
        $success = $this->fillPDF(public_path() . "/template/certificate/" . $filename, $outputfile, $nama);
        $message = [
            'status' => true,
            'message' => 'Successfully saved'
        ];
        return $message;
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
}
