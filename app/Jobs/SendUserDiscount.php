<?php

namespace App\Jobs;

use App\Mail\UserDiscount;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendUserDiscount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public  $userDiscount;

    public function __construct($userDiscount)
    {
        //
        $this->userDiscount = $userDiscount;
        $this->queue = 'send_user_discount';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->userDiscount->user->email)->send(new UserDiscount($this->userDiscount));
    }
}
