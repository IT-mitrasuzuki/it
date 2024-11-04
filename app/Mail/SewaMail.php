<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Sewa;

class SewaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sewa;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct(Sewa $sewa, $message)
    {
        $this->sewa = $sewa;
        $this->subject = "GENERAL AFFAIR REMINDER MASA BERLAKU KONTRAK (RUMAH/RUKO) : $sewa->nama_pengguna ";
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('pages.reminder.sewa.mail')
                    ->with([
                        'sewa' => $this->sewa,
                        'message' => $this->message,
                    ]);
    }
}
