<?php

namespace App\Repository\admin;

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
    public function sendCertificate($participant_id)
    {
        $participant = Participants::with('Event')->where('participant_id', $participant_id)->first();
        $event = Events::find($participant->event_id);
        $filename = $event->name.'-'.$participant->name.'.pdf';
        $data = [
            'name' => $participant->name,
            'email' => $participant->email,
            'title' => $event->name,
            'date' => Carbon::parse($event->start_date)->isoFormat('D MMMM Y'),
            'start_time' => Carbon::parse($event->start_time)->format('H:i A'),
            'end_time' => $event->end_time,
            'location' => $event->location,
            'certificate_filename' => $filename
        ];
        SendCertificateJob::dispatch($data);
    }

    public function sendCertificateToWa($data) {
        $participant_id = $data['participant_id'];
        $participant = Participants::with('Event')->where('participant_id', $participant_id)->first();
        $event = Events::find($participant->event_id);
        $name = $participant->name;
        $event_name = $event->name;
        $event_date = Carbon::parse($event->start_date)->isoFormat('D MMMM Y');
        $event_time = Carbon::parse($event->start_time)->format('H:i A');
        $link = route('certificate_download', ['eventName' => $event->name, 'participantName' => $participant->name]);
        $isi_pesan_WA_ke_pusat = "*Dear $name !*\nWe sincerely extend our heartfelt gratitude to you for your esteemed presence and active participation at our recent event, $event_name, held on $event_date. Your enthusiasm and engagement truly enriched the event's atmosphere.\n\nAs a token of our appreciation, we are thrilled to present you with a certificate recognizing your significant contribution to $event_name. Your insights and contributions played a pivotal role in the success of the event, and we are genuinely grateful for your involvement.\n\nYou can download your certificate by clicking on the following link: $link. This certificate serves as a lasting memento of your dedication and commitment to making $event_name a remarkable experience for all attendees.\n\nWe look forward to more opportunities to connect, learn, and grow together. Once again, thank you for being an integral part of $event_name and for making it a truly memorable occasion.\nThank You";
        $pusat = WablasTrait::sendText($data['phone_number'], $isi_pesan_WA_ke_pusat, 'pusat');
    }
}
