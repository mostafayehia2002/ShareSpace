<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $verification_code;
    public $resetPasswordUrl;
    public $userName;

    /**
     * Create a new message instance.
     */
    public function __construct($verification_code, $resetPasswordUrl, $userName)
    {
        $this->verification_code = $verification_code;
        $this->resetPasswordUrl = $resetPasswordUrl;
        $this->userName = $userName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Password Reset Code',
        );
    }

    /**
     * Get the message content definition.
     */


    public function content(): Content
    {
        return new Content(
            html: 'mail.reset-password',
            with: [
                'username' => $this->userName,
                'verification_code' => $this->verification_code,
                'resetPasswordUrl' => $this->resetPasswordUrl,
            ],

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
