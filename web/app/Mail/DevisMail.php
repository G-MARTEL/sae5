<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class DevisMail extends Mailable
{
    use Queueable, SerializesModels;

    public $devis;
    public $pdf;

    public function __construct($devis, $pdf)
    {
        $this->devis = $devis;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Votre devis est prêt')
            ->view('emails.devis') // Fichier Blade pour le corps du mail
            ->attachData($this->pdf->output(), "devis_{$this->devis->quote_request_id}.pdf", [
                'mime' => 'application/pdf',
            ]);
    }
}
