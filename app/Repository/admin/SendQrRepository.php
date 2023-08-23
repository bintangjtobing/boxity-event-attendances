<?php

namespace App\Repository\admin;

use Exception;
use App\Events;
use Carbon\Carbon;
use App\Participants;
use App\Jobs\SendQrCodeJob;
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
}
