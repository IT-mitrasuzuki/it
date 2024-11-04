<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Unit;

class UnitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $unit;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($unit, $message)
    {
        $this->unit = $unit;
        $this->subject = "GENERAL AFFAIR REMINDER PERPANJANG : $unit->nama - $unit->no_polisi ";
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('pages.reminder.unit.mail')
                    ->with([
                        'unit' => $this->unit,
                        'message' => $this->message,
                    ]);
    }
   
}
