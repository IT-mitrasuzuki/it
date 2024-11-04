<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Perjanjian;

class PerjanjianMail extends Mailable
{
    use Queueable, SerializesModels;

    public $perjanjian;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($perjanjian, $message)
    {
        $this->perjanjian = $perjanjian;
        $this->subject = "GENERAL AFFAIR REMINDER MASA BERLAKU PERJANJIAN : $perjanjian->nama_perjanjian ";
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('pages.reminder.perjanjian.mail')
                    ->with([
                        'perjanjian' => $this->perjanjian,
                        'message' => $this->message,
                    ]);
    }
}
