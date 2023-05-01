<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $orderDetail;
    public $user;
    public $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order, $orderDetail, $type = 1)
    {
        $this->user = $user;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->type == 1)
            return $this->view('guest.mails.order_mail')->with(['user' => $this->user, 'order' => $this->order, 'password' => $this->orderDetail]);
        else
            return $this->view('admin.mails.order_status_mail')->with(['user' => $this->user, 'order' => $this->order]);
    }
}
