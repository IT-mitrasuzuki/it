<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Asuransi;

class AsuransiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $asuransi;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct(Asuransi $asuransi, $message)
    {
        $this->asuransi = $asuransi;
        $this->subject = "GENERAL AFFAIR REMINDER INFO MASA BERLAKU : $asuransi->namaasuransi - $asuransi->nopol ";
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('pages.reminder.asuransi.mail')
                    ->with([
                        'asuransi' => $this->asuransi,
                        'message' => $this->message,
                    ]);
    }
}
