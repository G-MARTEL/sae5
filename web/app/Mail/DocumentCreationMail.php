<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentCreationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $document;

    /**
     * Create a new message instance.
     */
    public function __construct($client, $document)
    {
        $this->client = $client;
        $this->document = $document;
    }

    public function build()
    {
        return $this->subject('Un nouveau document a été créé')
                    ->view('emails.document_created')
                    ->with([
                        'clientName' => $this->client,
                        'documentTitle' => $this->document,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau document a été déposé sur votre espace client',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.document_created',
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
