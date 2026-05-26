<?php

namespace App\Mail;

use App\Models\Pet;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class ClinicalHistoryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Pet $pet
     * @param string $pdfData Raw PDF binary string
     */
    public function __construct(public Pet $pet, protected string $pdfData)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📋 Historial Clínico Completo — VetCare',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.clinical_history',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $filename = 'historial_clinico_' . strtolower(str_replace(' ', '_', $this->pet->name)) . '.pdf';

        return [
            Attachment::fromData(fn () => $this->pdfData, $filename)
                ->withMime('application/pdf'),
        ];
    }
}
