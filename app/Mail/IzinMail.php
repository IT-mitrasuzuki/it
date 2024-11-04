<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Izin;

class IzinMail extends Mailable
{
    use Queueable, SerializesModels;

    public $izin;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct(Izin $izin, $message)
    {
        $this->izin = $izin;
        $this->subject = "GENERAL AFFAIR REMINDER INFO MASA BERLAKU PERIZINAN : $izin->jenis - $izin->lokasi ";
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('pages.reminder.perizinan.mail')
                    ->with([
                        'izin' => $this->izin,
                        'message' => $this->message,
                    ]);
    }
   
}
