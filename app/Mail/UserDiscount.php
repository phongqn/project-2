<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserDiscount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $userDiscount;

    public function __construct($userDiscount)
    {
        $this->userDiscount = $userDiscount;
    }

    public function build()
    {
        return $this->view('admin.mails.userDiscount');
    }
}
