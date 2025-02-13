<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContractCreationMail extends Mailable
{
    use Queueable, SerializesModels;


    public $client;
    public $title;
    public $contractNumber;


    /**
     * Create a new message instance.
     */
    public function __construct($client, $title, $contractNumber)
    {
        $this->client = $client;
        $this->title = $title;
        $this->contractNumber = $contractNumber;
    }


    public function build()
    {
        return $this->subject('Vous avez souscrit à un nouveau contrat')
                    ->view('emails.contrat_created')
                    ->with([
                        'clientName' => $this->client,
                        'contratTitle' => $this->title,
                        'contractNumber' => $this->contractNumber,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau contrat ajouté a votre profil',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contrat_created',
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
