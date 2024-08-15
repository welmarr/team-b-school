<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrackRepairNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $requestData;

    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }

    public function build()
    {
        return $this->view('emails.track_repair_notification')
                    ->with([
                        'reference' => $this->requestData->reference,
                        'status' => $this->requestData->status,
                    ]);
    }
}