<?php

namespace App\Repository\admin;

use Exception;
use App\Events;
use Carbon\Carbon;
use App\Participants;
use App\Jobs\SendQrCodeJob;
use App\Traits\WablasTrait;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendQrRepository
{
    public function sendQrCode($token)
    {
        $image = QrCode::format('png')->merge("https://res.cloudinary.com/boxity-id/image/upload/v1678791753/asset_boxity/logo/icon-web_qusdsv.png", .2, true)->errorCorrection('H')->size(200)->generate($token);
        $output_file = public_path('images/participant/qr-code/img-' . time() . '.png');
        file_put_contents($output_file, $image);
        $participant = Participants::with('Event')->where('qr_code', $token)->first();
        $event = Events::find($participant->event_id);
        $check = Participants::where('participant_id', $participant->participant_id)->update([
            'qr_code_file_name' => $output_file
        ]);
        $data = [
            'name' => $participant->name,
            'email' => $participant->email,
            'qrcode_link' => $output_file,
            'title' => $event->name,
            'date' => Carbon::parse($event->start_date)->isoFormat('D MMMM Y'),
            'start_time' => Carbon::parse($event->start_time)->format('H:i A'),
            'end_time' => $event->end_time,
            'location' => $event->location
        ];
        SendQrCodeJob::dispatch($data);
    }

    public function sendQrCodeToWa($data) {
        $token = $data['token'];
        //save qrcode
        $image = QrCode::format('png')->merge("https://res.cloudinary.com/boxity-id/image/upload/v1678791753/asset_boxity/logo/icon-web_qusdsv.png", .2, true)->errorCorrection('H')->size(200)->generate($token);
        $output_file = public_path('images/participant/qr-code/img-' . time() . '.png');
        file_put_contents($output_file, $image);
        //end of save qrcode
        $participant = Participants::with('Event')->where('qr_code', $token)->first();
        $event = Events::find($participant->event_id);
        //update file qrcode
        $check = Participants::where('participant_id', $participant->participant_id)->update([
            'qr_code_file_name' => $output_file
        ]);
        $name = $participant->name;
        $event_name = $event->name;
        $event_date = Carbon::parse($event->start_date)->isoFormat('D MMMM Y');
        $event_time = Carbon::parse($event->start_time)->format('H:i A');
        $link = route('event_getQrCode', $token);
        $isi_pesan_WA_ke_pusat = "*Halo $name !*\nDengan senang hati kami informasikan bahwa pendaftaran Anda untuk $event_name telah berhasil diterima.\n\n*Detail Acara:*\n*Nama Acara :* $event_name\n*Tanggal :* $event_date\n*Waktu :* $event_time\n\nUntuk memastikan kelancaran proses check-in, harap tunjukkan kode QR berikut kepada staf acara pada saat kedatangan Anda :\nKlik tautan ini untuk mendapatkan kode QR :\n$link\n\nKami harap informasi ini bermanfaat bagi Anda.\nTerima kasih\nSalam,\n\n$event_name";
        $pusat = WablasTrait::sendText($data['phone_number'], $isi_pesan_WA_ke_pusat, 'pusat');
    }
}
