<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class StatusUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function build()
    {
        $subject = 'Status Update Notification';

        return $this->subject($subject)->view('emails.status-update-notification');
    }
}
