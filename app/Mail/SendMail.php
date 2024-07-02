<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $template;
    public $subject;
    /**
     * Create a new message instance.
     */
    public function __construct($details, $template, $subject)
    {
        //
        $this->details = $details;
        $this->template = $template;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Correo de prueba',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //print_r($this->details);exit;
        return new Content(
            view: $this->template,
            with: $this->details
        );
    }

    public function build(){
        //å∫dd($this->details);exit;
        return $this->from('mkt@tuin.ai')->view('mails.register');
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
