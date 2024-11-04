<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Pajak;

class PajakMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pajak;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct(Pajak $pajak, $message)
    {
        $this->pajak = $pajak;
        $this->subject = "GENERAL AFFAIR REMINDER MASA BERLAKU PAJAK : $pajak->jenis - $pajak->lokasi ";
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('pages.reminder.pajak.mail')
                    ->with([
                        'pajak' => $this->pajak,
                        'message' => $this->message,
                    ]);
    }
}
