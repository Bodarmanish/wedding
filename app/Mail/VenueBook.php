<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VenueBook extends Mailable
{
    use Queueable, SerializesModels;

    public $user_data;

    public function __construct($user_data)
    {
        $this->user_data = $user_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.venue-book');
        return $this->from('mr.yuvraj78@gmail.com')->subject('Venue Book')
        ->view('emails.venue-book')->with('data',$this->user_data);
    }
}
