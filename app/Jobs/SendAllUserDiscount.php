<?php

namespace App\Jobs;

use App\Mail\UserDiscountAll;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendAllUserDiscount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userAllDiscount;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userAllDiscount)
    {
        $this->userAllDiscount = $userAllDiscount;
        $this->queue = 'send_all_mail_discount';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd($this->userAllDiscount);
        $listMail=array_map(function($e){
            return $e['user']['email'];
                    }, $this->userAllDiscount);
        Mail::bcc($listMail)->send(new UserDiscountAll($this->userAllDiscount));
    }
}
