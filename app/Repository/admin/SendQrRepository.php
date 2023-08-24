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
        $image = QrCode::format('png')->size(200)->generate($token);
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
        $image = QrCode::format('png')->size(200)->generate($token);
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
        $isi_pesan_WA_ke_pusat = "*Dear $name !*\nWe are excited to inform you that your registration for the $event_name has been successfully received. Thank you for choosing to be a part of this event!\n\n*Event Details:*\n*Event Name:* $event_name\n*Date:* $event_date\n*Time:* $event_time\n\nTo ensure a smooth check-in process, please present the following QR code to the event staff upon your arrival:\nClick this link for get the qr Code :\n$link\nOur staff will use the QR code for verification of your attendance at the event. Your cooperation is greatly appreciated.\n\nIf you have any questions or require further assistance, please do not hesitate to contact us.\nThank You";
        $pusat = WablasTrait::sendText($data['phone_number'], $isi_pesan_WA_ke_pusat, 'pusat');
    }
}
