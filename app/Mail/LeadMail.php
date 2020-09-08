<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadMail extends Mailable
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
        return $this->markdown('emails.lead.create-lead');

        return $this->from('mr.yuvraj78@gmail.com')->subject('Welcome Mail')
        ->view('emails.lead.create-lead')->with('data',$this->user_data);

        // return $this->view('emails.lead.create-lead')
        // ->with([
        //     'name' => $this->user->name,
        //     'url' => route('activateUser',['token'=>$this->user->confirmation_token])
        // ]);
    }
}
