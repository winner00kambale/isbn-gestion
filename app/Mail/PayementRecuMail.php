<?php

namespace App\Mail;

use App\Models\Payement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class PayementRecuMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payement;

    public function __construct(Payement $payement)
    {
        $this->payement = $payement;
    }

    public function build()
    {
        // Générer le PDF depuis la vue
        $pdf = Pdf::loadView('pdf.recu_payement', ['payement' => $this->payement]);

        return $this->subject('Reçu de paiement')
                    ->view('emails.payement_recu')
                    ->attachData($pdf->output(), 'recu_payement.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
