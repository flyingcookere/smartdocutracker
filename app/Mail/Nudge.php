<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Carbon\Carbon;
use App\Models\User;

class Nudge extends Mailable
{
    use Queueable, SerializesModels;
    private $document;
    private $users;
    /**
     * Create a new message instance.
     */
    public function __construct($document)
    {
        $this->document = $document;
        $this->users = User::where('email', '!=',$this->document['sender_email'])
        ->whereNotNull('email_verified_at')
        ->get();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
       return new Envelope(
            subject: $this->document['title'],
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
                view: 'mail.nudge',
                with:['name' => $this->document['sender'],
                    'title' => $this->document['title'],
                    'status' =>  $this->document['status'],
                    'uuid' => $this->document['uuid'],
                    'received_by' => $this->document['recipient'] ?? null,
                    'recipient_email' => $this->document['recipient_email'],
                    'users' => $this->users,
                    'sender_dept' => $this->document['sender_dept'],
                    'recipient_department' => $this->document['recipient_dept'],
                    'receiving_email' => $this->document['recipient_email'],
                    'url' => route('document.logs', $this->document['uuid']),
                    'daysSince' => floor(abs(Carbon::now()->diffInDays($this->document['created_at'])))
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
