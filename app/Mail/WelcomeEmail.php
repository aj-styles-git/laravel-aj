<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $data =[];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data= $data ; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = "test.smartdesigns@gmail.com";
        return $this->from($from)->subject($this->data['subject'])->view('pages.globals.emails.welcome_email')->with('data',$this->data);
    }
}
