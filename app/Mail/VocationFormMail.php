<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VocationFormMail extends Mailable
{
    use Queueable, SerializesModels;
    public $bodyContent;
    public function __construct($bodyContent)
    {
        $this->bodyContent = $bodyContent;
    }
    public function envelope()
    {
        return new Envelope(
            subject: 'Vocation Mail - De La Salle Brothers',
        );
    }
    public function content()
    {
        return new Content(
            view: 'admin.mail.vocation',
        );
    }
    public function attachments()
    {
        return [];
    }
}
