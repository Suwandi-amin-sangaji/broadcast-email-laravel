<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class TicketEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket; // Data tiket yang akan dikirim

    /**
     * Create a new message instance.
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informasi Tiket: Bank Papua Sorong Raja Ampat Maraton 2024',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket', // Nama view untuk email
            with: [
                'ticket' => $this->ticket, // Kirim data ke view
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
        // Melampirkan gambar dengan Content-ID (CID)
        return [
            Attachment::fromPath(public_path('assets/image/logo.png'))
                ->as('logo.png') // Nama file
                ->withMime('image/png'), // Tipe MIME
        ];
    }
}
