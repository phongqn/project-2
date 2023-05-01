<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserDiscountAll extends Mailable
{
    use Queueable, SerializesModels;

    public $userAllDiscount;

    public function __construct($userAllDiscount)
    {
        $this->userAllDiscount = $userAllDiscount;
    }

    public function build()
    {
        return $this->view('admin.mails.userAllDiscount');
    }
}
