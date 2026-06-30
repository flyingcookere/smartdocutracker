<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class MailableName extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    private $document;

    public function __construct($document)
    {
        $this->document = $document;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->document->title,
            from: new Address (env('MAIL_FROM_ADDRESS'),
             env('MAIL_FROM_NAME'))
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.notifyTrack',
            with:['name' => $this->document->sender,
            'title' => $this->document->title,
            'received_date'=> $this->document->created_at,
            'status' =>  $this->document->status,
            'uuid' => $this->document->uuid,
            'received_by' => $this->document->recipient,
            'received_by_email' => $this->document->recipient_email,
            'received_by_dept' => $this->document->recipient_dept,
            'remarks' => $this->document->remarks,
            'url' => route('document.logs', $this->document->uuid),
            ]
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
