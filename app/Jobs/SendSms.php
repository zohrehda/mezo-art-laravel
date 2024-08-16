<?php

namespace App\Jobs;

use App\Classes\KaveNegar;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $to ;
    public $message ;
    public function __construct($to,$message)
    {
        $this->to=$to ;
        $this->message=$message ;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sms_client=new KaveNegar() ;
        $sms_client->send($this->to,$this->message) ;
    }
}
