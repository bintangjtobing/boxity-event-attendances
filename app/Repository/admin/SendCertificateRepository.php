<?php

namespace App\Repository\admin;

use App\Certificates;
use Exception;
use App\Events;
use App\Jobs\SendCertificateJob;
use Carbon\Carbon;
use App\Participants;
use App\Traits\WablasTrait;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendCertificateRepository
{
    public function sendCertificate($data)
    {
        $participant_name = $data['name'];
        $participant_email = $data['email'];
        $event_name = $data['event'];
        $event_location = $data['location'];
        $event_start_date = $data['start_date'];
        $event_start_time = $data['start_time'];
        $event_end_time = $data['end_time'];
        $filename = $event_name.'-'.$participant_name.'.pdf';
        $data = [
            'name' => $participant_name,
            'email' => $participant_email,
            'title' => $event_name,
            'date' => Carbon::parse($event_start_date)->isoFormat('D MMMM Y'),
            'start_time' => Carbon::parse($event_start_time)->format('H:i A'),
            'end_time' => $event_end_time,
            'location' => $event_location,
            'token' => $filename
        ];
        SendCertificateJob::dispatch($data);
    }

    public function sendCertificateToWa($data) {
        $participant_name = $data['name'];
        $event_name = $data['event'];
        $event_start_date = $data['start_date'];
        $event_date = Carbon::parse($event_start_date)->isoFormat('D MMMM Y');
        $link = route('certificate_download', ['eventName' => $event_name, 'participantName' => $participant_name]);
        $isi_pesan_WA_ke_pusat = "*$participant_name yang terhormat!*\nTerima kasih atas kehadiran dan partisipasi aktif Anda di $event_name kami baru-baru ini, yang diadakan pada tanggal $event_date. Antusiasme dan keterlibatan Anda benar-benar memperkaya suasana acara.\n\nSebagai bentuk apresiasi kami, dengan senang hati kami mempersembahkan kepada Anda sertifikat yang mengakui kontribusi signifikan Anda pada Acara Pengujian Hari ini.\n\nAnda dapat mengunduh sertifikat Anda dengan mengklik tautan berikut : $link\n\nSekali lagi, terima kasih telah menjadi bagian integral dari $event_name, dan menjadikannya acara yang benar-benar berkesan.\nKami harap informasi ini bermanfaat bagi Anda.\nTerima kasih.\nSalam,\n\n$event_name";
        $pusat = WablasTrait::sendText($data['no_hp'], $isi_pesan_WA_ke_pusat, 'pusat');
    }

    public function updateSendedCertificate($data) {
        Certificates::where('participant_id', $data['participant_id'])->where('event_id', $data['event_id'])->update([
            'status' => 1
        ]);
    }

    public function saveQrCodeCertificate($token)
    {
        // Check if the QR code with the given token already exists
        $existingQrCodePath = public_path('images/certificate/qr-code/img-' . $token . '.png');

        if (file_exists($existingQrCodePath)) {
            // QR code already exists, no need to create again
            return;
        }

        $verif = route('certificate_verification', ['token' => $token]);
        $image = QrCode::format('png')->merge('https://res.cloudinary.com/boxity-id/image/upload/v1693136775/Logo_ABPPTSI_nfb8ns.png', .2, true)->errorCorrection('H')->size(200)->generate($verif);
        $output_file = public_path('images/certificate/qr-code/img-' . $token . '.png');
        file_put_contents($output_file, $image);
    }
}
