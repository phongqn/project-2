<?php

namespace App\Jobs;

use App\Mail\OrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public $order;
    public $orderDetail;
    public $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $order, $orderDetail, $type = 1)
    {
        $this->user = $user;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->type = $type;
        $this->queue = 'order_queue';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type == 1)
            Mail::to($this->user['email'])->send(new OrderMail($this->user, $this->order, $this->orderDetail));
        else Mail::to($this->user['email'])->send(new OrderMail($this->user, $this->order, $this->orderDetail, $this->type));
    }
}
