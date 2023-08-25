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
            'certificate_filename' => $filename
        ];
        SendCertificateJob::dispatch($data);
    }

    public function sendCertificateToWa($data) {
        $participant_name = $data['name'];
        $event_name = $data['event'];
        $event_start_date = $data['start_date'];
        $event_date = Carbon::parse($event_start_date)->isoFormat('D MMMM Y');
        $link = route('certificate_download', ['eventName' => $event_name, 'participantName' => $participant_name]);
        $isi_pesan_WA_ke_pusat = "*Dear $participant_name !*\nWe sincerely extend our heartfelt gratitude to you for your esteemed presence and active participation at our recent event, $event_name, held on $event_date. Your enthusiasm and engagement truly enriched the event's atmosphere.\n\nAs a token of our appreciation, we are thrilled to present you with a certificate recognizing your significant contribution to $event_name. Your insights and contributions played a pivotal role in the success of the event, and we are genuinely grateful for your involvement.\n\nYou can download your certificate by clicking on the following link: $link. This certificate serves as a lasting memento of your dedication and commitment to making $event_name a remarkable experience for all attendees.\n\nWe look forward to more opportunities to connect, learn, and grow together. Once again, thank you for being an integral part of $event_name and for making it a truly memorable occasion.\nWe hope this information is useful for you.\nThank you.\nBest Regards,\n\nPT. Boxity Central Indonesia | #togetherWithBoxityERP";
        $pusat = WablasTrait::sendText($data['phone_number'], $isi_pesan_WA_ke_pusat, 'pusat');
    }

    public function updateSendedCertificate($data) {
        Certificates::where('participant_id', $data['participant_id'])->where('event_id', $data['event_id'])->update([
            'status' => 1
        ]);
    }
}
