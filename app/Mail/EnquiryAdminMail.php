<?php

namespace App\Mail;

use App\Models\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnquiryAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Enquiry $enquiry)
    {
    }

    public function build()
    {
        $subject = 'New enquiry: '.($this->enquiry->subject ?: 'Whizseed');

        return $this->subject($subject)
            ->replyTo($this->enquiry->email, $this->enquiry->name)
            ->view('emails.enquiry-admin');
    }
}
