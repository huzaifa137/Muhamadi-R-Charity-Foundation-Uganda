<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class AdminPasswordResetMail extends Mailable
{
    public function __construct(public string $name, public string $url, public int $minutes = 60)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Reset your administrator password');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.admin-password-reset');
    }
}
