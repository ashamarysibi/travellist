<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
       
       $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'ashamarysibi@mca.ajce.in';
        $subject = 'This is a demo!';
        $name = 'Jane Doe';
        
     return $this->subject('Message For User Authentication')
                    ->view('emails.welcome')
                    ->with('data', $this->data);
    
      }
    }

