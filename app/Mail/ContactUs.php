<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $contactmsg;
    public function __construct($contactmsg)
    {
         $this->contactmsg = $contactmsg;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('email.contact-us')->with([
                        'message_mail' => $this->contactmsg['contact_message'],
                        'attched_name' => $this->contactmsg['att_image_name'],
                        'screen_shot' => $this->contactmsg['screenshot_n'],
                    ]);
    }
}
