<?php

namespace App\Jobs;

use App\Mail\SendQrCodeMail;
use Illuminate\Bus\Queueable;
use App\Mail\SendCertificateMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendCertificateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendCertificateMail($this->details);

        // Attachment: Certificate
        $certificatePath = public_path('images/certificate/qr-code/img-' . $this->details['token']);
        $email->attach($certificatePath, [
            'as' => $this->details['token'], // Set the desired filename and extension
            'mime' => 'application/pdf', // Adjust the MIME type if needed
        ]);

        try {
            Mail::to($this->details['email'])->send($email);
            Log::info('Certificate email sent successfully.');
        } catch (\Exception $e) {
            Log::error('Certificate email failed to send: ' . $e->getMessage());
        }
    }
}
